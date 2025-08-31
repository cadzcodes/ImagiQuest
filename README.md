# ImagiQuest 🎨✨

[![GitHub stars](https://img.shields.io/github/stars/cadzcodes/ImagiQuest?style=flat-square)](https://github.com/cadzcodes/ImagiQuest/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/cadzcodes/ImagiQuest?style=flat-square)](https://github.com/cadzcodes/ImagiQuest/network)
[![GitHub issues](https://img.shields.io/github/issues/cadzcodes/ImagiQuest?style=flat-square)](https://github.com/cadzcodes/ImagiQuest/issues)
[![GitHub license](https://img.shields.io/github/license/cadzcodes/ImagiQuest?style=flat-square)](https://github.com/cadzcodes/ImagiQuest/blob/main/LICENSE)
[![Laravel Version](https://img.shields.io/badge/Laravel-10.x-red?style=flat-square&logo=laravel)](https://laravel.com)

> **"Unleash your imagination with AI"**

![ImagiQuest Banner](https://raw.githubusercontent.com/cadzcodes/ImagiQuest/main/public/images/banner.png)

## 🚀 About ImagiQuest

**ImagiQuest** is a cutting-edge AI-powered image generation platform built with Laravel that transforms your wildest ideas into stunning visual masterpieces. Whether you're an artist, designer, content creator, or simply someone who loves to explore creativity, ImagiQuest provides you with powerful tools to generate, discover, and manage AI-created artwork.

With our intuitive interface and advanced AI integration, you can create professional-quality images from simple text descriptions, discover visually similar images through our reverse search technology, and build your personal gallery of generated masterpieces.

## 📸 Demo & Screenshots

<!-- Add your screenshots/GIFs here -->

![Demo GIF](https://raw.githubusercontent.com/yourusername/imagiquest/main/public/images/demo.gif)

🔗 **[Live Demo](https://your-demo-url.com)** | 📖 **[Documentation](https://docs.your-project.com)**

## ✨ Features

-   🎭 **AI Text-to-Image Generation** - Transform any text prompt into stunning visuals
-   🔍 **Reverse Image Search** - Upload an image and discover visually similar AI-generated artwork
-   👤 **User Authentication & Profiles** - Secure account management with personal dashboards
-   💾 **Image Library Management** - Save, organize, and manage your generated images
-   ⬇️ **High-Quality Downloads** - Download images in multiple formats and resolutions
-   🎨 **Free-form Prompting** - No restrictions - describe anything and watch it come to life
-   📱 **Responsive Design** - Works seamlessly across desktop, tablet, and mobile devices
-   ⚡ **Real-time Generation** - Fast processing with live generation status updates
-   🏷️ **Image Tagging & Search** - Organize your creations with custom tags
-   📊 **Usage Analytics** - Track your generation history and statistics

## 🛠️ Tech Stack

| Category           | Technologies                                   |
| ------------------ | ---------------------------------------------- |
| **Backend**        | Laravel 10.x, PHP 8.2+                         |
| **Frontend**       | Blade Templates, Alpine.js, Livewire           |
| **Styling**        | TailwindCSS, Heroicons                         |
| **Database**       | MySQL 8.0 / PostgreSQL 13+                     |
| **AI Integration** | OpenAI DALL-E, Stable Diffusion, Replicate API |
| **Authentication** | Laravel Breeze                                 |
| **File Storage**   | Laravel Storage (Local/S3/CloudFlare R2)       |
| **Queue System**   | Redis, Laravel Horizon                         |
| **Search**         | Laravel Scout, Meilisearch                     |

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

-   **PHP 8.2+** with extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
-   **Composer** (latest version)
-   **Node.js 18+** and **npm**
-   **MySQL 8.0+** or **PostgreSQL 13+**
-   **Redis** (for queues and caching)
-   **Git**

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/imagiquest.git
cd imagiquest
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables

Edit your `.env` file with the following essential configurations:

```env
# Application
APP_NAME=ImagiQuest
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=imagiquest
DB_USERNAME=your_username
DB_PASSWORD=your_password

# AI Service APIs (choose one or multiple)
OPENAI_API_KEY=your_openai_api_key
REPLICATE_API_TOKEN=your_replicate_token
STABILITY_API_KEY=your_stability_ai_key

# File Storage
FILESYSTEM_DISK=local
# For S3: AWS_ACCESS_KEY_ID, AWS_SECRET_ACCESS_KEY, AWS_DEFAULT_REGION, AWS_BUCKET

# Queue Configuration
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Mail Configuration (for user notifications)
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

### 5. Database Setup

```bash
# Run database migrations
php artisan migrate

# Seed the database (optional)
php artisan db:seed
```

### 6. Build Assets

```bash
# Build frontend assets
npm run build

# Or for development with hot reloading
npm run dev
```

### 7. Start the Application

```bash
# Start the Laravel development server
php artisan serve

# In a separate terminal, start the queue worker
php artisan queue:work

# Access the application at: http://localhost:8000
```

## 📖 Usage

### Generating Images

1. **Sign up** for a new account or **log in** to your existing account
2. Navigate to the **Generate** page
3. Enter your creative prompt in the text field (e.g., "A majestic dragon flying over a crystal castle at sunset")
4. Select your preferred settings:
    - Image style (Realistic, Artistic, Cartoon, etc.)
    - Aspect ratio (Square, Portrait, Landscape)
    - Quality level
5. Click **Generate** and wait for the AI magic to happen!
6. **Save** your favorite creations to your personal library
7. **Download** images in your preferred format and resolution

### Reverse Image Search

1. Go to the **Search** page
2. **Upload an image** from your device or provide an image URL
3. Our AI will analyze the image and find visually similar generated artwork
4. Browse through the results and discover new inspiration
5. Save interesting finds to your collection

### Managing Your Library

-   View all your generated and saved images in **My Gallery**
-   Organize images with custom **tags** and **collections**
-   **Search** through your library using keywords or tags
-   **Share** your favorite creations with the community
-   **Download** images individually or in bulk

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help make ImagiQuest even better:

### Getting Started

1. **Fork** the repository
2. **Clone** your fork: `git clone https://github.com/yourusername/imagiquest.git`
3. **Create** a feature branch: `git checkout -b feature/amazing-new-feature`
4. **Make** your changes
5. **Test** thoroughly
6. **Commit** your changes: `git commit -m 'Add amazing new feature'`
7. **Push** to your branch: `git push origin feature/amazing-new-feature`
8. **Submit** a Pull Request

### Development Guidelines

-   Follow **PSR-12** coding standards for PHP
-   Use **meaningful commit messages**
-   Add **tests** for new features
-   Update **documentation** as needed
-   Ensure all **tests pass** before submitting PRs

### Code Style

```bash
# Format your code
./vendor/bin/pint

# Run tests
php artisan test

# Run static analysis
./vendor/bin/phpstan analyse
```

## 🗺️ Roadmap

### 🔄 Current Development

-   [ ] **Image Editing Suite** - Inpainting, outpainting, and background removal
-   [ ] **Batch Generation** - Generate multiple variations at once
-   [ ] **Advanced Prompt Builder** - GUI for complex prompt construction

### 🚀 Upcoming Features

-   [ ] **Social Features** - Share, like, and comment on community creations
-   [ ] **API Access** - RESTful API for developers and integrations
-   [ ] **Mobile App** - Native iOS and Android applications
-   [ ] **Collaborative Galleries** - Shared workspaces for teams
-   [ ] **Advanced AI Models** - Integration with latest image generation models
-   [ ] **NFT Integration** - Mint your creations as NFTs
-   [ ] **Video Generation** - Expand to AI-generated video content

### 💡 Future Vision

-   [ ] **Plugin System** - Extensible architecture for third-party integrations
-   [ ] **Enterprise Features** - Advanced admin controls and analytics
-   [ ] **AI Training** - Custom model fine-tuning capabilities
-   [ ] **Marketplace** - Buy and sell AI-generated artwork

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

### Technologies & Frameworks

-   **[Laravel](https://laravel.com)** - The elegant PHP framework that powers our backend
-   **[TailwindCSS](https://tailwindcss.com)** - For beautiful, utility-first styling
-   **[Alpine.js](https://alpinejs.dev)** - Lightweight JavaScript framework for interactivity

### AI Service Providers

-   **[OpenAI](https://openai.com)** - For DALL-E integration
-   **[Stability AI](https://stability.ai)** - For Stable Diffusion models
-   **[Replicate](https://replicate.com)** - For AI model hosting and scaling

### Special Thanks

-   Our amazing **open-source contributors** who make this project possible
-   The **Laravel community** for continuous inspiration and support
-   **Beta testers** who provided invaluable feedback during development
-   **AI researchers** pushing the boundaries of what's possible

---

<div align="center">

### 💖 Support the Project

If you find ImagiQuest helpful, please consider:

⭐ **Starring** the repository  
🐛 **Reporting** issues  
💡 **Suggesting** new features  
🤝 **Contributing** code  
📢 **Sharing** with others

**Made with ❤️ by the ImagiQuest Team**

[Website](https://your-website.com) • [Documentation](https://docs.your-project.com) • [Discord](https://discord.gg/your-invite) • [Twitter](https://twitter.com/your-handle)

</div>
