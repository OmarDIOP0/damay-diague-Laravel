import {getAllLessons} from "./modules/lesson-module.js";
import {getCourses} from "./modules/course-module.js";
import {getLessonItemView} from "./helpers.js";

let coursesList = [];

$(() =>{
  $("#menu-item2").addClass("active");

  getCourses(setCoursesList);


  $("#btn-next").click(()=>{
    let currentSlide = $("#carousel .slide.active-slide");
    let nextSlide = $("#carousel .slide.active-slide").next();

    currentSlide.removeClass("active-slide");

    if(nextSlide.length === 0){
      nextSlide = $("#carousel .slide").first();
    }

    nextSlide.addClass("active-slide");
  })

  $("#btn-prev").click(()=>{
    let currentSlide = $("#carousel .slide.active-slide");
    let prevSlide = currentSlide.prev();

    currentSlide.removeClass("active-slide");

    if(prevSlide.length === 0){
      prevSlide = $("#carousel .slide").last();
    }
    prevSlide.addClass("active-slide");
  })
})

function displayLessons(data){
  $("#last-lessons").empty();
  data.map(item =>{
    let course = coursesList.filter(c =>c.id==item.id_course)[0];
    item.course = course;
    $("#last-lessons").append(getLessonItemView(item));
  });

}

function setCoursesList(data) {
  coursesList = data;
  getAllLessons(displayLessons);
}
