# winbar_school

Win B. A. R. Academy online enrollment portal.

All styles are in the root `style.css`; palette tokens are in `assets/css/theme-charcoal.css`. Pages in `Admin/` and `student/` share it through the `includes/head.php` files. See `REDESIGN-NOTES.md` for the design system, the placeholder images to replace, and the backend issues found during the redesign.

## Quick setup

1. Put this folder in `C:\xampp\htdocs\` and start Apache and MySQL.
2. phpMyAdmin > Import > `database/online_enroll.sql`.
3. Open `http://localhost/winbar_school-main/` and log in as `admin` / `Admin@2026` or `25-1001` / `Student@2026`.

See `REDESIGN-NOTES.md` for details.
