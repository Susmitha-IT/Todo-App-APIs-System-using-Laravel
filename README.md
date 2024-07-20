# Building Todo Application REST APIs with Laravel

- Execution Video :  [Video](https://drive.google.com/file/d/158BBSZ6uM2cZ9lsq71u89cImYgmha2zK/view?usp=sharing)
 1. **Task Model**
     - Database Migration:
       The database migration creates the tasks table with the necessary columns (id, user_id, task, status => pending or done => (default pending ) using Laravel's migration system.

     - Eloquent Relationships:
       Eloquent relationships are established between the Task and User models.
       One-to-Many Relationship: Each user can have multiple tasks. The user_id column in the tasks table serves as a foreign key referencing the id column in the users table, ensuring data integrity and allowing 
       efficient query optimizations.

 2. **Authentication**:
    - APIs are secured using an API_KEY ('helloatg') via middleware. Invalid keys prompt appropriate error responses (status => 0, "Invalid API key" message).
      
       ![image](https://github.com/user-attachments/assets/59273815-7a7f-4243-aaa5-2746dea19b55)
       
    - When the API_KEY header is disabled or removed in Postman and the request is sent, the API will respond with status => 0 and an error message of 'Invalid API key', indicating authentication failure due to an invalid or missing API_KEY."
      
      ![image](https://github.com/user-attachments/assets/e97e9c17-0548-45ed-a747-0cdf88f8077d)

      ![image](https://github.com/user-attachments/assets/727dde06-5dd5-4613-8c58-5f42201639c2)

 3. **TaskController**:
    
    - Manages endpoints for adding tasks (POST /todo/add) and updating task status (POST /todo/status).  Responses include detailed task objects, status indicators, and messages for user feedback.

      Adding tasks (POST /todo/add)
    ![image](https://github.com/user-attachments/assets/06c51e6f-8285-48e3-b0b8-2635da50c95f)
    ![image](https://github.com/user-attachments/assets/00ccf8b9-c6ac-4a5e-ae9b-e1bc5633b40a)

      Updating task status (POST /todo/status)
    ![image](https://github.com/user-attachments/assets/9833197f-788f-482d-8ab7-623146266d41)
    ![image](https://github.com/user-attachments/assets/62813e4e-0d06-4093-830c-669a35c13941)



# User-Authentication-System-using-Laravel
- Execution Video : [Video](https://drive.google.com/file/d/1LFJ6rHNfuDj8ewuW40drnuF5lIqxdcpQ/view?usp=drive_link)
  
 **Home Page**
   ![image](https://github.com/user-attachments/assets/305fb92b-4626-4399-9295-7c6688fb31e7)

   

1. **Database Interaction Using Laravel Eloquent**
  ![image](https://github.com/user-attachments/assets/1f0dcab2-33b1-406b-ab77-58879dca6094)
  ![image](https://github.com/user-attachments/assets/c6b12ea4-8d73-4af5-8374-4fd0daae9ceb)


3. **Backend Validation**
   - Validate the name, email, and password fields using Laravel validators.
   ![image](https://github.com/user-attachments/assets/7d1b9f16-ec4d-49a0-b6da-4d7e39565c62)
   ![image](https://github.com/user-attachments/assets/588bbb39-f4bb-4681-9d0d-f85d861c1ebf)

   


4. **User Registration and Password Hashing**
   - Register a user with hashed password and unique email.
   ![image](https://github.com/user-attachments/assets/672f68fd-3249-42a4-a76b-c2aa92e05233)


5. **Login Functionality**
   - Implement login using registered email and password.
   ![image](https://github.com/user-attachments/assets/bfb7bed0-3031-4746-90cd-4d80c64a8a7e)



6. **Protected Dashboard**
   - Protect the dashboard using route middleware and display a message in login page.
  ![image](https://github.com/user-attachments/assets/57809f35-3411-4d81-9ff5-bcbf22df2319)




