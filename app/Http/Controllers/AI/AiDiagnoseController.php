<<<<<<< SEARCH
=======
    public function handlePost($request)
    {
        if ($request->getPath() === $this->getRedirect())
        {
            return;
        }

        // Handle redirection logic here
        // For example, redirect to home page
        $this->getRedirect();
    }

    /**
     * Redirects back to the home page after a request.
     * @param $request The incoming request object
     * @return array The response object
     */
    public function getRedirect()
    {
        return 'http://localhost:3000/home'; // Replace with your actual home page URL
    }
}
>>>>>>> REPLACE
