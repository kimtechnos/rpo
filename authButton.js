function updateAuthButton() {
    // Check if an existing user is logged in
    const isLoggedIn = checkLoggedIn();

    // Get the auth button element
    const authButton = document.getElementById('auth-button');
    const authButtonLink = authButton.querySelector('a');

    // Update the button label and behavior based on the login status
    if (isLoggedIn) {
        authButtonLink.textContent = 'Log Out';
        authButtonLink.href = 'logout.php';
    } else {
        authButtonLink.textContent = 'Sign Up / Log In';
        authButtonLink.href = 'registration/index.php';
    }
}