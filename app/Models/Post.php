<?php

namespace App\Models;

use App\Enum\PostStatus;
use App\Notifications\PostPublishedNotification;
use Auth;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $first_published_at
 * @property mixed $content
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static Builder<static>|Post forUser(?\App\Models\User $user)
 * @method static Builder<static>|Post homeFeed($onlyShowFollowing = false)
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereDescription($value)
 * @method static Builder<static>|Post whereFirstPublishedAt($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereStatus($value)
 * @method static Builder<static>|Post whereTitle($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 * @method static Builder<static>|Post withRichText($fields = [])
 * @mixin \Eloquent
 */
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use HasRichText;

    /**
     * The dynamic rich text attributes.
     *
     * @var array<int|string, string>
     */
    protected $richTextAttributes = [
        'content',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'status',
        'first_published_at',
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the post is published.
     */
    public function isPublished(): bool
    {
        return $this->status === PostStatus::PUBLISHED->value;
    }

    /**
     * Check if the post is the first time publishing.
     */
    public function isFirstTimePublishing(): bool
    {
        return $this->isPublished() && $this->first_published_at !== $this->updated_at;
    }

    /**
     * Notify followers of the post.
     */
    public function notifyFollowers(): void
    {
        Auth::user()->followers->each(function (User $user) {
            $user->notify(new PostPublishedNotification($this));
        });
    }

    /**
     * Scope a query for the home feed to only show published posts and not the logged in user's own posts.
     */
    #[Scope]
    protected function homeFeed(Builder $query, $onlyShowFollowing = false): LengthAwarePaginator
    {
        $user = Auth::user();

        return $query
            ->when($user != null, function ($query) use ($user) {
                $query->where('user_id', '!=', $user->id);
            })
            ->when(Gate::check('filter-followings', User::class) && $onlyShowFollowing, function ($query) use ($user) {
                $user->followings()->pluck('users.id')->each(function ($id) use ($query) {
                    $query->where('user_id', $id);
                });
            })
            ->where('status', PostStatus::PUBLISHED->value)
            ->orderByDesc('created_at')
            ->with('user')
            ->paginate(10);
    }

    // TODO should use the PostPolicy 'view'
    /**
     * Scope a query to filter based on a user's permissions.
     */
    #[Scope]
    protected function forUser(Builder $query, ?User $user): Builder
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser == null || (!$loggedInUser->isModerator() && !$loggedInUser->isAdmin() && $loggedInUser->id !== $user->id)) {
            $query->where('status', PostStatus::PUBLISHED->value);
        }

        return $query->where('user_id', $user->id)->orderByDesc('created_at');
    }
}
