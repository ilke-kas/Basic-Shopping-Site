# 💸 MiniShop

A PHP-based mini e-commerce and wallet management system built as part of a university course project. This application allows users to securely log in, manage funds, purchase items, and return them — simulating a basic online shopping experience. It demonstrates full-stack web development skills using HTML, CSS, PHP, and MySQL.

> 🎓 **Developed as part of an academic project in Bilkent University**  
> 🧠 **Focus:** Backend logic, session management, database interaction, and frontend UI design

---

### ✅ Core Functionalities

#### 🔐 Authentication
- Secure login/logout using PHP sessions
- Blocks unauthorized access to internal pages
- Displays error messages for invalid login attempts

#### 👤 User Dashboard
- Shows a welcome message and current wallet balance
- Navigation buttons: Profile, Add Money, Buy Items, Return Items

#### 💳 Add Money
- Form-based interface to increase wallet balance
- Displays success or failure feedback

#### 🛍 Purchase Items
- Deducts from wallet if sufficient balance
- Prevents purchase if funds are insufficient
- Tracks purchases internally

#### ↩️ Return Items
- Lets users return purchased items
- Automatically refunds balance
- Displays confirmation or error messages

#### 🧾 Profile Page
- Displays user information and balance
- Shows a table of past transactions
- Allows quick navigation to key actions (add money, return item, logout)

#### 🎨 Frontend Styling
- Three separate CSS files for modular design:
  - `style.css` → Login UI
  - `welcomestyle.css` → Dashboard
  - `profilestyle.css` → Profile & Transactions
- Consistent button styling, color scheme, and alert boxes

---

### 🗂 File Structure

| File               | Description |
|--------------------|-------------|
| `index.php`        | Homepage or redirector to login |
| `login.php`        | User login form and handler |
| `logout.php`       | Logs user out and destroys session |
| `welcome.php`      | Post-login dashboard |
| `profile.php`      | Displays balance and transactions |
| `addmoney.php`     | Handles money addition |
| `buy.php`          | Handles purchases |
| `returnitem.php`   | Handles item returns |
| `config.php`       | Database connection settings |
| `style.css`        | Login page styling |
| `welcomestyle.css` | Dashboard page styling |
| `profilestyle.css` | Profile and transaction table styling |

---

### 🔐 Security Highlights

- PHP session-based access control
- Input validation with contextual error messages
- Clearly separated concerns in codebase
- Plaintext passwords in this version (for demo only) — should be hashed using `password_hash()` in production

---

### 💻 Tech Stack

- **Frontend:** HTML, CSS (no frameworks)
- **Backend:** PHP (vanilla)
- **Database:** MySQL
- **Authentication:** PHP Sessions

---

### 🚀 Possible Extensions

- 🔐 Add user registration and password hashing
- 🛒 Make purchases dynamic with a products database
- 🧑‍💼 Admin panel for user/item management
- 📧 Add email confirmations
- ⚙️ Implement AJAX to improve user interaction
- 📱 Improve mobile responsiveness with Bootstrap or Tailwind

---

### 🧠 Learning Outcomes

Through this project, I applied:
- Session-secured user authentication
- PHP-to-MySQL database interactions
- Dynamic form handling with conditional logic
- CSS structuring for multi-view web apps
- Real-world transaction simulation logic

