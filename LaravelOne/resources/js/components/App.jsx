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

            {/* Navigation */}
            {isAuthenticated() ? (
                <nav className="-mx-3 flex flex-1 justify-end space-x-4">
                    <a
                        href="/dashboard"
                        className="rounded-md px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Dashboard
                    </a>
                </nav>
            ) : (
                <nav className="-mx-3 flex flex-1 justify-end space-x-4">
                    <a
                        href="/login"
                        className="rounded-md px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Log in
                    </a>
                    <a
                        href="/register"
                        className="rounded-md px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Register
                    </a>
                </nav>
            )}
             {/* Website description card */}
             <div className="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
                <h1 className="text-3xl font-bold mb-4 text-gray-800">Platform Features</h1>

                {/* Features Section */}
                <div className="mb-6">
                    <h2 className="text-2xl font-semibold mb-2 text-gray-800">User Authentication and Authorization</h2>
                    <ul className="list-disc list-inside text-gray-600 space-y-2">
                        <li>Administrator SignUp</li>
                        <li>Administrator Signin</li>
                        <li>User SignUp</li>
                        <li>User Signin</li>
                        
                    </ul>
                </div>

                {/* Product Management Features */}
                <div className="mb-6">
                    <h2 className="text-2xl font-semibold mb-4 text-gray-800">Manage Products</h2>
                    <ul className="list-disc list-inside text-gray-600 space-y-2">
                        <li>Create new products</li>
                        <li>View a list of products</li>
                        <li>Edit existing products</li>
                        <li>Delete products</li>
                        <li>Filter products by category</li>
                        <li>Pagination for product listing</li>
                    </ul>
                </div>

                {/* Category Management Features */}
                <div className="mb-6">
                    <h2 className="text-2xl font-semibold mb-4 text-gray-800">Manage Categories</h2>
                    <ul className="list-disc list-inside text-gray-600 space-y-2">
                        <li>Create new categories</li>
                        <li>View a list of categories</li>
                        <li>Edit existing categories</li>
                        <li>Delete categories</li>
                    </ul>
                </div>
            </div>

            
        </div>
    );
};

export default App;
