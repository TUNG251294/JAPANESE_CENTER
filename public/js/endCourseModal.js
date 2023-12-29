function endCourseModal() {
    Swal.fire({
        title: "Sure you want to end this course?",
        text: "The attendance rate of students in the course will be calculated.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, end it!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("end-course-form").submit();
        } else {
            Swal.close();
        }
    });
}
