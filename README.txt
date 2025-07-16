=========================================
Login & Register System with PHP + JSON
=========================================

📌 Project Description:
-----------------------
This is a simple PHP-based Login and Register system that stores user data in a local `users.json` file instead of using a database like MySQL. It features:

- Clean and modern UI (Login + Register forms)
- Toggle between forms with smooth animation
- Stores users with username, email, and password
- Prevents duplicate usernames
- Fully functional frontend and backend (no database required)
- Good for learning session-less auth and JSON handling in PHP

🛠 Technologies Used:
---------------------
- PHP
- HTML5
- CSS3 (Responsive layout with flexbox)
- Vanilla JavaScript (for form toggling)
- JSON (as database)

📁 File Structure:
-------------------
/project-folder
│
├── index.php              ← Main UI + logic handler
├── users.json             ← Stores user info in JSON format
└── README.txt             ← You’re reading it 🙂

🧪 How It Works:
-----------------
1. Users can register by filling in a username, email, and password.
2. On registration:
    - The system checks if the username already exists.
    - If not, it saves the user data in `users.json`.
3. On login:
    - The script verifies the username & password from the JSON file.
    - If correct, shows a success message. If not, shows an error.

✅ Notes:
---------
- This version does not use sessions or cookies (can be added later).
- Passwords are stored in plain text for learning purposes — not secure for production use!
- To reset users, just delete or empty `users.json` and add `[]`.

🚀 How to Run:
--------------
1. Place the project in your local server (e.g., XAMPP `htdocs/` or Laravel Valet).
2. Make sure `users.json` is writable:
   - Set permissions: `chmod 777 users.json` (Linux/Mac)
3. Open your browser and go to:
   http://localhost/project-folder/

📦 Recommended Improvements (future):
-------------------------------------
- Add password hashing
- Use PHP sessions to handle login state
- Add logout feature
- Input validations with JS
- Role-based redirection (admin/user)

👨‍💻 Author:
------------
- Developed by Kousha 🔥

