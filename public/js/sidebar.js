const currentLocation = location.href;
const menuItem = document.getElementsByClassName("nav-link");
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
    if (menuItem[i].href == currentLocation) {
        menuItem[i].className += " active";
    }
}
// The icon activates an animation when the 'a' tags are clicked.
$(document).ready(function () {
    $("#link_course_list, #link_personal_course, #link_create_course").click(
        function () {
            $("#downListIcon1").addClass("fa-spin");
        }
    );
    $("#link_admin_list, #link_teacher_list, #link_student_list").click(
        function () {
            $("#downListIcon2").addClass("fa-spin");
        }
    );
    $("#link_create_admin, #link_create_teacher, #link_create_student").click(
        function () {
            $("#downListIcon3").addClass("fa-spin");
        }
    );
});

const editCourseUrl = /^\/admin\/courses\/.+\/edit$/;
const courseInfoUrl = /^\/courses\/.+\/info$/;
if (
    location.pathname.startsWith("/courses/list") ||
    location.pathname.endsWith("/manage-session") ||
    location.pathname.endsWith("/receipt-fee") ||
    location.pathname.endsWith("/register") ||
    location.pathname.match(editCourseUrl) ||
    location.pathname.match(courseInfoUrl)
) {
    document.getElementById("link_course_list").className += " active";
}

if (
    location.pathname.startsWith("/personal-courses") ||
    location.pathname.endsWith("/attendance")
) {
    document.getElementById("link_personal_course").className += " active";
}

if (
    location.pathname.startsWith("/users/admin") ||
    location.pathname.endsWith("/edit-admin")
) {
    document.getElementById("link_admin_list").className += " active";
}

if (
    location.pathname.startsWith("/users/teacher") ||
    location.pathname.endsWith("/edit-teacher")
) {
    document.getElementById("link_teacher_list").className += " active";
}

if (
    location.pathname.startsWith("/users/student") ||
    location.pathname.endsWith("/edit-student")
) {
    document.getElementById("link_student_list").className += " active";
}
// When a tag with the class 'active' is present, add the 'show' class to its parent tag within the ul tag.
if (
    $("#link_course_list").hasClass("active") ||
    $("#link_personal_course").hasClass("active") ||
    $("#link_create_course").hasClass("active")
) {
    $(document).ready(function () {
        $("#course_menu").addClass("show");
        $("#user_menu").removeClass("show");
        $("#create_menu").removeClass("show");
        $("#downListIcon1")
            .removeClass("fa-angle-left")
            .addClass("fa-angle-down");
    });
}

if (
    $("#link_admin_list").hasClass("active") ||
    $("#link_teacher_list").hasClass("active") ||
    $("#link_student_list").hasClass("active")
) {
    $(document).ready(function () {
        $("#course_menu").removeClass("show");
        $("#user_menu").addClass("show");
        $("#create_menu").removeClass("show");
        $("#downListIcon2")
            .removeClass("fa-angle-left")
            .addClass("fa-angle-down");
    });
}
if (
    $("#link_create_admin").hasClass("active") ||
    $("#link_create_teacher").hasClass("active") ||
    $("#link_create_student").hasClass("active")
) {
    $(document).ready(function () {
        $("#course_menu").removeClass("show");
        $("#user_menu").removeClass("show");
        $("#create_menu").addClass("show");
        $("#downListIcon3")
            .removeClass("fa-angle-left")
            .addClass("fa-angle-down");
    });
}

if (location.pathname.startsWith("/account/edit")) {
    $(document).ready(function () {
        $("#div_update_account").css({
            "background-color": "#0d6efd",
            "border-radius": "6px",
        });
    });
}
