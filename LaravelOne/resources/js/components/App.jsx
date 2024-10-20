// resources/js/App.jsx
import React from 'react';

// Function to check if the user is authenticated
const isAuthenticated = () => {
    // This assumes the variable is set in the Blade view
    console.log('window.authenticated:', window.authenticated); // Debug log
    return window.authenticated; // Access the variable set in the Blade view
};

const App = () => {
    return (
        <div className="container mx-auto p-4">
            <h1>Hello, React!</h1>
            <p>This is a simple React component inside a Laravel application.</p>

            {/* Navigation */}
            {isAuthenticated() ? (
                <nav className="-mx-3 flex flex-1 justify-end">
                    <a
                        href="/dashboard"
                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                </nav>
            ) : (
                <nav className="-mx-3 flex flex-1 justify-end">
                    <a
                        href="/login"
                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>
                    <a
                        href="/register"
                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                </nav>
            )}
        </div>
    );
};

export default App;
