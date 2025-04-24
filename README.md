# 🚀 News Portal Documentation

### A **modern news portal** built with Laravel , designed to make it easy for users to read and share news and for admins to manage content efficiently. It includes cool features like real-time notifications, fast performance, and secure user management.

## 🎥 Video Tutorials

 🔹 Check out the Live Demo! <a href="https://www.youtube.com/watch?v=Dpxt3HZdiqg" target="_blank">[Click Here]</a> <br>
 🔹 Watch the Complete Tutorial Series! <a href="https://www.linkedin.com/feed/update/urn:li:activity:7318422212816863232/" target="_blank">[click here]</a>

## 🌟 Features

## 🔹User Features

### 🚀 1. **Authentication**  
   #### ✅ Login, Register, Reset Password, and Email Verification , Logout.
   #### ✅ OTP verification for password reset.
   #### ✅ Social login using OAuth [`Google` , `Facebook`] With SOLID design prencipals best practices[`single responsability` , `open-closed` , `dependancy inversion`]. 
   #### ✅ Profile management: Users can view and edit their profile details (name, username, email, password,image etc.).
   #### ✅ Password change feature using the same profile page.
   
## 🚀 2. **Post Management**  
   #### ✅ Users can create, edit, delete and view posts.
   #### ✅ Real-time increment of post view counts.
   #### ✅ Preview post images using `file-input` package and can delete the previewed images without reloading the page using `jQuery` and `Ajax` . 
   #### ✅ Preview post long description using `summerenote` package . 
   #### ✅ Enable comments on posts or not [can not add comments if that disabled] . 
   #### ✅ Specify which category that post related to ! .
   #### ✅ Make a validation on uploded number of posts in frontend using `file-input` package and also in backend using custom form validation classes. [separte that logic to add clearity in post controller class]
   #### ✅ Display number of views for each post.

## 🚀 3. **Comments**  
   #### ✅ Users can add comments on active posts using `jQuery` and `Ajax` [adding in realtime without reload the page].
   #### ✅ Notify post author when someone add a new comment on his/her post and display these notifications in top-navbar [realtime and database notifications using pusher websocket server and Laravel Echo to listen to realtime events].
   #### ✅ Hide/show comments based on post settings[`active` or `inactive` when creating or updating it using `jQuery` and `Ajax`].

## 🚀 4. **Notifications**  
   #### ✅ Real-time notifications for comments and other activities [using `Pusher` , `Laravel Echo` , `jQuery` and `Ajax`].
   #### ✅ Display unread notifications count in top-navbar.
   #### ✅ Display limited number of unread notifications in top-navbar.
   #### ✅ Display all of unread notifications in user dashboard notification page and can select any one and mark it as read or mark all as read [that handled by using middleware]..
   #### ✅ Can delete any of displayed unread notifications or delete all from databae .
   #### ✅ SweetAlert2 is used for confirmation on logouts.
   #### ✅ Database notifications for to store user notifications [it uses UUID not incremental id for no notification redundancy].

## 🚀 5. **Social Authentication**  
   #### ✅ Users can login via Facebook and Google [by using SOLID prencipals to make that clean `single responsability` , `dependancy inversion` , `open-closed`].

## 🚀 6. **Phone Validation**  
   #### ✅ Validate users phone numbers using the `Laravel-Phone` package on the Contact Us page and user.

## 🚀 7. **Advanced Filters**
   #### ✅ Users can filter posts by category, search by title [realtime search using `jQuery` and `Ajax`].

## 🚀 8. **Techical Support**
   #### ✅ Users can contact the website support team via the `Whatsapp` . 
   #### ✅ OR Users can contact the website support team but via `Contact-Us` page and admins will be notifyed with message in admin dashboard [realtime notification in admin dashboard and this notification stored in database].

## 🚀 8. **Website Social Contacts**
   #### ✅ Users can go to social link for website like [`Google` , `Facebook` , `Twitter` , `Instagram`  , `Youtube` , `email` , `phone`] in navbar and use service provides to handle that logic as a globla site settings . 

## 🚀 9. **Search Engine Optimization (SEO)**
   #### ✅ In show post page make a meta discription with long description of post so when some when search can get result on `Google` as first search result. 
   #### ✅ Used for each element in html body for all project blade views `title` to enhance `SEO` .
   #### ✅ Used canonical links with pagination to enhance `SEO` . 
   #### ✅ Adding headig in each page like `H1` or `H2` to rank the page in `Google Search` and that also enhance `SEO` .#
   #### ✅ Using post slug instead of id for better `SEO`.

## 🚀 10. **Home Page**
   #### ✅ Display top 5 most viewed posts in home page.
   #### ✅ Display top 5 latest posts in home page.
   #### ✅ Display top 5 popular posts in home page.
   #### ✅ Display top 5 oldest posts in home page.
   #### ✅ Display top 3 latest posts from `cache` in slider. 
   #### ✅ Display `Read More` posts from `cache` as a top latest 10 posts. 

## 🚀 11. **Footer Site Setting**
   #### ✅ Display website social contacts in footer.
   #### ✅ Display Useful Links. 
   #### ✅ User can send newsletter email. 

## 🚀 12. **Posts Caching**
   #### ✅ Posts are cached using `Redis` for improved performance.
   #### ✅ When adding a new post , edit or also delete it will forget all `redis` caching keys to update latest details .
   #### ✅ Main 3 latest posts in slider are cached using `redis` and `predis` package to give a high performance [so not required all times request a server with database query] .
   #### ✅ `Read More` posts section also cached using `redis` and `predis` package to enhance performance and give a better user experience.

## 🔹Admin Features

## 🚀 1. **Admin Dashboard**  
   #### ✅ Admin can log in, reset password, and manage their profile.
   #### ✅ Admin receives notifications for reset requests, and OTP verification is used for password reset.
   #### ✅ Admin can reset password and it will send an email notification via email with otp token [i used `laravel-Otp` package to send otp and can make otp valid with specific time , number of characters and whose will be notified with that]

## 🚀 2. **User Management**  
   #### ✅ Authorized admin can view, blocked/unblocked users.
   #### ✅ Authorized admin can delete blocked/unblocked users.
   #### ✅ Authorized admin can block user and then when this use try to login it will check it's status and will display for it a waiting list page. 
   #### ✅ Authorized admin cab search users by different filters: sort by, limit by, order by and status.
   #### ✅ Authorized admin can manage user status (active/inactive).
   #### ✅ Authorized admin can view user information by using a `Bootstrap-Modula` and `laravel-components`.
   
## 🚀 3. **Posts Management**  
   #### ✅ Authorized admin can add, update, delete, and search posts and categories.
   #### ✅ Authorized admin can manage the CRUD operations for posts.
   #### ✅ Authorized admin can show posts details like `number-of-views` , `user who creates that post` , `status` , `comment abiliy`.
   #### ✅ Authorized admin can also make the post `active` or `inactive` depending on `status` if it becomes `inactive` it will not appear in the frontend user home page . 
   #### ✅ Authorized admin can show all comments for any post and also show how writes these comments .
   #### ✅ If Authorized admin create a new post , edit or also delete it will clear or forget all cache keys to get the latest updated posts with new details in frontend user home page. 

## 🚀 4. **Authorization [Roles And Permessions]**  
   #### ✅ Manage multiple admins with full CRUD (create, read, update, delete).
   #### ✅ Super admins can assign roles and permissions to other admins, controlling access to various features.
   #### ✅ Super admin can add , show , edit , delete role .
   #### ✅ Super admin can add , show , edit , delete permessions for any role.
   #### ✅ Super admin can assign a role to specific admin and can make all permessions of that role.
   #### ✅ Authorized admin can show modules that is allowed for him to access based on his permessions [use middleware `can` and `@can` blade directive to check if the auth user if authorized for that action or not and if not , it will restrict his actions]. 

## 🚀 5. **Admin Notifications**  
   #### ✅ Authorized admin receives notifications about various user activities and can mark them as read.
   #### ✅ Authorized admin for notification page can access the all unread notifications and can mark them all as read or delete all or delete specific or also mark one as read.
   #### ✅ Authorized admin for notifications can show all count number of notifications . 
   #### ✅ For show realtime notifications in admin i used `pusher` websocket server with `laravel Echo` to listen for for `pusher` notification events and `jQuery` and `Ajax` for realtime update content without refreshing the the page and also after that store the notification in database to make a CRUD operations on it later.
   

## 🚀 6. **Advanced Filters**  
   #### ✅ Admin can filter data by status, limit, order, and sort across various modules.
   #### ✅ General search functionality across all authorized admin pages.

## 🚀 7. **Advanced Filters**
   #### ✅ Authorized admin can filter posts by category, search by title, and sort by date [realtime search using `jQuery` and `Ajax`].
   #### ✅ Authorized admin can search posts by title, category, and author.
   #### ✅ Authorized admin can filter posts by category and search by title.
   #### ✅ Authorized admin can sort posts by date, title, and category.
   #### ✅ Authorized admin can filter posts by category and search by title.

## 🚀 8. **Category Managements**
   #### ✅ Authorized admin for categories managements can access all categories data like `name` , `status` , `created_date` , `number of posts in that category`. 
   #### ✅ Authorized admin for categories managements can `show` , `edit` , `delete` , `update` category.
   #### ✅ Authorized admin for categories managements can `active` or `inactive` categories and if the category becomes `inactive` it will not be appearing in the frontend user home page . 
   #### ✅ Authorized admin for categories managements can search for categories with `name` , `status` , `create_date` and also `sortby:id,name,created_at` and can limited the results with `specifc limited number`.
   #### ✅ Authorized admin for categories managements can add new categories with `bootstrap-modula` .

## 🚀 9. **Conatcts Management**
   #### ✅ Authorized admin for contacts managements can access all Conatcts data like `name` ,`email` , `subject` , `phone` , `status` , `created_date`. 
   #### ✅ Authorized admin for contacts managements can `show` , `edit` , `delete` , `update` conatcts.
   #### ✅ Authorized admin for contacts managements can `active` or `inactive` contact and if the contact.
   #### ✅ Authorized admin for contacts managements can make a contact `status` as `read` when click on show page of that contact or when click on notification of that contact in admin dashboard navbar it will make that notification as read and it redirect the admin to `show page for contact` and also can make it's status as read.

## 🚀 10. **Site Settings Managements**
   #### ✅ Authorized admin for Site Setting managaments can update site settings data like `site name` , `phone` ,  `email`  , `social links` , `logo` , `favicon` , `locations` ... .

## 🚀 11. **Admin Profile Managements**
   #### ✅ Authorized admin for edit profile managaments can edit thier profiles , change password , edit basic info , ... .

---
## 💼 Packages Used

#### ✅ 🚀**Laravel Eloquent Sluggable**: Automatically generates SEO friendly slugs for posts.
#### ✅ 🚀**Laravel Breeze**: Provides basic authentication features like login, registration, and password reset.
#### ✅ 🚀**Laravel Debugbar**: Debugging tools to enhance development.
#### ✅ 🚀**Laravel Predis**: Caching using Redis.
#### ✅ 🚀**Laravel N+1 Detector**: Detects N+1 query issues and optimizes queries.
#### ✅ 🚀**Eloquent Eager Limit**: Optimizes performance by reducing the number of queries (before: 59 queries, after: 12 queries).
#### ✅ 🚀**PHP Laravel Flasher**: Push notifications (toast notifications) to the frontend.
#### ✅ 🚀**MailTrap**: Used for sending test emails via SMTP.
#### ✅ 🚀**jQuery & Ajax**: Used to handle real-time data updates on the frontend without page reload.
#### ✅ 🚀**Summernote**: A text editor for text areas (e.g., post content).
#### ✅ 🚀**Laravel Phone**: Used to validate phone numbers.
#### ✅ 🚀**Bootstrap FileInput**: Allows image preview, drag and drop support for file inputs.
#### ✅ 🚀**Laravel OTP**: Implements OTP (One Time Password) for secure password resets.
#### ✅ 🚀**Pusher & Laravel Echo**: Real-time notifications using WebSockets.
#### ✅ 🚀**SweetAlert2**: Provides beautiful alerts for various actions, like logout confirmation.

## How to Run the Project

### Prerequisites

### Make sure you have the following installed:

#### ✅ **PHP >= 8.1>=**
#### ✅ **Composer**
#### ✅ **Laravel 10>=**
#### ✅ **Node.js & npm** (for frontend assets)

📷 Screenshots : 
---
### Admin Sceenshots :
![screencapture-news-portal-net-admin-dashboard-2025-03-11-00_07_36](https://github.com/user-attachments/assets/f49f7d8b-4b12-40ff-b157-8da6fb801376)
![screencapture-news-portal-net-admin-roles-create-2025-03-11-00_10_40](https://github.com/user-attachments/assets/32809b67-8fd8-4abf-8177-e4a289495a7a)
![screencapture-news-portal-net-admin-roles-2025-03-11-00_10_08](https://github.com/user-attachments/assets/9a02f550-ad0a-4fe6-be6c-5cba961c8a84)
![screencapture-news-portal-net-admin-users-2025-03-11-00_11_28](https://github.com/user-attachments/assets/6bfa7a90-91c3-4a9b-a018-64154c11c794)
![screencapture-news-portal-net-admin-users-create-2025-03-11-00_11_43](https://github.com/user-attachments/assets/f27d26dc-501c-4f5f-973d-f1eff388bc0c)
![screencapture-news-portal-net-admin-notifications-2025-03-11-00_15_43](https://github.com/user-attachments/assets/60c6e2ac-e417-4017-a8f8-41ddeb80bf57)
![screencapture-news-portal-net-admin-contacts-1-edit-2025-03-11-00_14_49](https://github.com/user-attachments/assets/976124ec-3035-4c37-8629-c499eb8df51c)
![screencapture-news-portal-net-admin-contacts-1-2025-03-11-00_14_19](https://github.com/user-attachments/assets/2d3d22c3-bcb9-432a-84ef-a6788ff51020)
![screencapture-news-portal-net-admin-contacts-2025-03-11-00_13_31](https://github.com/user-attachments/assets/64765602-50f1-40b4-8739-21a8a7c7ecd4)
![screencapture-news-portal-net-admin-posts-create-2025-03-11-00_13_14](https://github.com/user-attachments/assets/adddbd45-5c50-4682-a3cd-e29f639b173e)
![screencapture-news-portal-net-admin-posts-2025-03-11-00_13_04](https://github.com/user-attachments/assets/3260e8d5-00e7-467b-8cb8-eef282e10d69)
![screencapture-news-portal-net-admin-categories-2025-03-11-00_12_54](https://github.com/user-attachments/assets/a5cd76ed-f5a2-4a03-a274-69adee018e8b)
![screencapture-news-portal-net-admin-users-status-in-active-2025-03-11-00_11_57](https://github.com/user-attachments/assets/9ab73d66-f558-4f8c-91e2-eec9ec9e6e3a)


### Installation Steps
### 1. Clone the repository:

   ```bash
   git clone https://github.com/Mahmoud-Hagrass/News-Portal-And-Magazine-Website.git
   ```

### 🔹 Step 2: Install Composer

First, install PHP dependencies using Composer:
```bash
composer install
```

### 🔹 Step 2: Install Node Dependencies
Then, install Node.js dependencies using npm:
```bash
npm install
```


### 🔹 Step 3: Environment Setup
```bash
cp .env.example .env
```

### 🔹 Step 4: Generate the application key:
```bash
php artisan key:generate
```

### 🔹 Step 5: Database Configuration
```bash
php artisan migrate --seed
```

### 🔹 Step 6: Setup Storage
```bash
php artisan storage:link
```

### 🔹 Step 7: Run the Application
### if you use xampp server use that : 
```bash
php artisan serve
```
### if you use laragon server you just need to click on start button.


## 🔑 Admin Login Credentials

###  📧 **Email**: admin@admin.com
###  🔑 **Password**: 123456789


## 📩 Contact Me
### 💼 **Need a PHP Laravel Developer? Let's work together!**

###  📧 **Email**: mahmoudhagras19@gmail.com
###  📲 **WhatsApp**: +201206814586


---

### 📜 License
### 🔹 This project is **MIT Licensed** – Feel free to use & modify!

---

### ⭐ If you find this project helpful, don't forget to star it! ⭐










