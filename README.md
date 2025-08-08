# Echo Diary

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![DaisyUI](https://img.shields.io/badge/DaisyUI-5A0EF8?style=for-the-badge&logo=daisyui&logoColor=white)](https://daisyui.com/)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)](https://alpinejs.dev/)
[![Docker](https://img.shields.io/badge/Docker-2CA5E0?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com/)

Echo Diary is a modern, feature-rich journaling web application built with Laravel and DaisyUI. It provides users with a beautiful and intuitive platform to document their thoughts, experiences, and memories in a secure and organized manner.

## ✨ Features

- 📝 Rich text journal entries with formatting
- 🌟 Favorite and commenting system
- 📨 Mail and in-app notifications
- 🔐 User authentication and authorization
- 🛡️ Moderation and administration features
- 🌍 Multi-language support (English, French, Dutch)
- 📱 Responsive design for all devices
- ⚡ Fast and efficient performance

## 🚀 Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js 18+ and bun
- Docker and Docker Compose

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/echo-diary.git
   cd echo-diary
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   bun install
   ```

4. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Set up the database and mail server**
   ```bash
   docker compose up -d
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   bun run build
   ```

8. **Start the development server**
   ```bash
   composer run dev
   ```

   The application will be available at `http://localhost:8000`

### IDE Helpers

Generate IDE helper files for better code completion:

```bash
php artisan ide-helper:generate
php artisan ide-helper:models -RW
```

### Testing

Run the test suite:

```bash
composer test
```

## 📦 Built With

- [Laravel](https://laravel.com/) - The PHP Framework
- [DaisyUI](https://daisyui.com/) - Component library for Tailwind CSS
- [Alpine.js](https://alpinejs.dev/) - A minimal framework for composing JavaScript behavior
- [Docker](https://www.docker.com/) - Containerization platform

## 👨‍💻 Author

**Lorenzo Catalano**
- Website: [Portfolio](https://lorenzo3117.github.io/portfolio/)
- Email: lorenzo.catalano@outlook.com

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.
