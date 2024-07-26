# Service Order App - Web Portal

This is the Web Portal component of the Service Order App, that has also a [mobile application](https://github.com/EstevanLJ/osapp).

This project was built with Laravel for backend and user [Looper Template](https://themes.getbootstrap.com/product/looper-responsive-admin-template/) for the frontend.

This app features:
* API authentication with token
* API endpoint for SO submissions form the mobile app
* Web authentication and sign in
* Image DB storage with base64 encoding
* PDF generation with data and images
* Option to upload certificate and sign the generated PDFs
* PDFs are generated in background jobs
* Admin page to list the failed jobs and check the logs