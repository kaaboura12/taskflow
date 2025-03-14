# TaskFlow 📋✨

<div align="center">

![TaskFlow Logo](https://placehold.co/800x200/5D5FEF/FFFFFF?text=TaskFlow)

[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Symfony](https://img.shields.io/badge/Symfony-6.4-000000.svg?style=for-the-badge&logo=symfony&logoColor=white)](https://symfony.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3.svg?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

**A modern, intuitive task management system built by [Mohamed Amin Sayari](https://github.com/kaaboura12)**

[Features](#features) • [Screenshots](#screenshots) • [Installation](#installation) • [Usage](#usage) • [Contact](#contact)

</div>

## 🚀 Features

- **💻 Modern UI/UX**: Clean, intuitive interface with responsive design
- **📊 Kanban Board**: Drag-and-drop task organization across different status columns
- **✅ Task Management**: Create, edit, delete, and organize tasks
- **🔔 Priority Levels**: Set task priorities and due dates
- **👥 Team Collaboration**: Assign tasks to team members
- **🔐 User Authentication**: Secure login and registration system
- **📱 Dashboard**: Visual overview of task status and progress
- **⚡ Real-time Updates**: Instantly update task status and completion

## 📸 Screenshots

<div align="center">
  <img src="https://placehold.co/800x400/5D5FEF/FFFFFF?text=TaskFlow+Dashboard" alt="TaskFlow Dashboard" width="600px">
  <p><em>TaskFlow Dashboard - Intuitive task management</em></p>

  <img src="https://placehold.co/800x400/5D5FEF/FFFFFF?text=TaskFlow+Kanban" alt="TaskFlow Kanban" width="600px">
  <p><em>Drag and drop task management with Kanban view</em></p>
</div>

## 🔧 Technologies Used

- **Backend**: Symfony 6.4, PHP 8.1+
- **Database**: Doctrine ORM with support for MySQL/PostgreSQL
- **Frontend**: Bootstrap 5, JavaScript, AJAX
- **UI Components**: Font Awesome icons, Google Fonts
- **Security**: Symfony Security Bundle for authentication and authorization

## ⚙️ Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or PostgreSQL 12+
- Node.js 16+ and npm/yarn (for asset building)
- Symfony CLI (optional, but recommended)

### Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/kaaboura12/taskflow.git
   cd taskflow
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies and build assets:
   ```bash
   npm install
   npm run build
   # OR with Yarn
   yarn install
   yarn build
   ```

4. Configure your database in `.env.local` (create this file first):
   ```
   DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/taskflow?serverVersion=8.0"
   ```

5. Create the database and run migrations:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. (Optional) Load sample data:
   ```bash
   php bin/console doctrine:fixtures:load --no-interaction
   ```

7. Start the Symfony development server:
   ```bash
   symfony server:start
   ```

8. Access the application at `http://localhost:8000`

### Default Admin Account

After loading fixtures, you can log in with these credentials:
- Email: `admin@taskflow.com`
- Password: `admin123`

## 📘 Usage

### User Registration and Login

1. Register a new account with your email, name, and password
2. Log in with your credentials
3. Access your personalized dashboard

### Task Management

1. Create new tasks with title, description, priority, and due date
2. Assign tasks to team members
3. Organize tasks by dragging them between status columns
4. Mark tasks as completed
5. Edit or delete tasks as needed

### Dashboard

The dashboard provides an overview of:
- Tasks assigned to you
- Task completion progress
- Task distribution by status
- High-priority tasks

## 📁 Project Structure

```
taskflow/
├── assets/             # Frontend assets (JS, CSS)
├── bin/                # Symfony console commands
├── config/             # Application configuration
├── migrations/         # Database migrations
├── public/             # Public web directory
├── src/                # PHP source code
│   ├── Controller/     # Controllers
│   ├── Entity/         # Doctrine entities
│   ├── Form/           # Form types
│   ├── Repository/     # Doctrine repositories
│   └── ...
├── templates/          # Twig templates
│   ├── base.html.twig  # Base template
│   ├── dashboard/      # Dashboard templates
│   ├── security/       # Authentication templates
│   ├── task/           # Task templates
│   └── ...
└── ...
```

## 🎨 Customization

TaskFlow is designed to be easily customizable:

- **Theme**: Modify the CSS variables in `assets/styles/app.scss` to change colors
- **Features**: Extend the Task entity to add custom fields
- **Workflow**: Modify the status options in `src/Form/TaskType.php` to match your workflow

## 🔍 Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check your `.env.local` file for correct database credentials
   - Ensure your database server is running

2. **Symfony Server Won't Start**
   - Verify that port 8000 is not in use
   - Check PHP version compatibility

3. **Assets Not Loading**
   - Run `npm run build` or `yarn build` again
   - Clear browser cache

For more issues, please [open a ticket](https://github.com/kaaboura12/taskflow/issues) on our GitHub repository.

## 👥 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Contact

Mohamed Amin Sayari - [@kaaboura12](https://github.com/kaaboura12) - mohamed.sayari@example.com

Project Link: [https://github.com/kaaboura12/taskflow](https://github.com/kaaboura12/taskflow)

## 🙏 Acknowledgements

- [Symfony](https://symfony.com/) - The PHP framework used
- [Bootstrap](https://getbootstrap.com/) - Frontend framework
- [Font Awesome](https://fontawesome.com/) - Icons
- [Google Fonts](https://fonts.google.com/) - Typography 