function getBackPageRoute() {
    if (location.pathname.startsWith("/personal-courses")) {
        return (location.href = "/courses/your-course");
    }
    return (location.href = "/courses/list");
}
