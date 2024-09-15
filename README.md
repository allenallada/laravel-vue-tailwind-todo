# Simple TODO App

## Running the Server Locally

To run the Project locally, follow these steps:

1. **Install dependencies**:
    ```sh
    composer install
    npm install
    ```

2. **Copy the `.env` file**:
    ```sh
    cp .env.example .env
    ```

3. **Generate the application key**:
    ```sh
    php artisan key:generate
    ```

4. **Configure the `.env` file**:
    Open the `.env` file and set your database credentials and other necessary configurations.

5. **Run the migrations**:
    ```sh
    php artisan migrate
    ```

6. **Compile the frontend assets**:
    ```sh
    npm run dev
    ```

7. **Start the development server**:
    ```sh
    php artisan serve
    ```

    The server will start at `http://localhost:8000`.

8. **Access the application**:
    Open your browser and go to `http://localhost:8000`.