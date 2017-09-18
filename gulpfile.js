var gulp = require("gulp");
var sass = require("gulp-sass");
var autoprefixer = require("gulp-autoprefixer");
var plumber = require("gulp-plumber");

gulp.task("sass", function() {
    gulp.src("./css/sass/*.scss")
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest("./css/*.css"))
});

gulp.task("default", function() {
    gulp.watch("./css/sass/*.scss",["sass"]);
});
