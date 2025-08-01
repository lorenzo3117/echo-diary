<?php

namespace App\Models;

use App\Enum\PostStatus;
use Auth;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $content
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static Builder<static>|Post forUser(?\App\Models\User $user)
 * @method static Builder<static>|Post homeFeed()
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereDescription($value)
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
    ];

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
            ->when($onlyShowFollowing, function ($query) use ($user) {
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
    protected function forUser(Builder $query, ?User $user): LengthAwarePaginator
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser == null || (!$loggedInUser->isModerator() && !$loggedInUser->isAdmin() && $loggedInUser->id !== $user->id)) {
            $query->where('status', PostStatus::PUBLISHED->value);
        }

        return $query->where('user_id', $user->id)->orderByDesc('created_at')->paginate(10);
    }
}
