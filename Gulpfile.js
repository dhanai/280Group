var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var plumber = require( 'gulp-plumber' );
var sass        = require('gulp-sass');
var minifycss = require( 'gulp-minify-css' );
var rename = require( 'gulp-rename' );
var concat = require('gulp-concat');
var uglify = require( 'gulp-uglify' );

var onError = function( err ) {
  console.log( 'An error occurred:', err.message );
  this.emit( 'end' );
}

var devSite = "www.280group.dev.cc";

gulp.task('server', function() {
    
    //optional section for local development syncing - comment out the following return command if you want to use this server function
    //return;
    browserSync.init({
        proxy: devSite
    });    
    gulp.watch("**/*.php").on('change', browserSync.reload);
    gulp.watch('assets/js/**/*.js', browserSync.reload);
    
});

gulp.task( 'styles', function() {
    return gulp.src('assets/css/*.scss')
        .pipe( plumber( { errorHandler: onError } ) )
        .pipe( sass() )
        .pipe(rename('bundle.css'))
        .pipe(gulp.dest("./assets/css"))
        .pipe( minifycss() )
        .pipe( rename( { suffix: '.min' } ) )
        .pipe(gulp.dest('assets/css'))
        .pipe(browserSync.stream({match: '**/*.css'}));
} );

gulp.task('scripts', function(){
     gulp.src([
        './assets/js/vendor/*.js',
        './assets/js/partials/*.js'
        ])
        .pipe(concat('bundle.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./assets/js/')) 
});

gulp.task('html', function() {
    return gulp.src('*.html').pipe(gulp.dest('./'));
});

gulp.task('default', ['server', 'styles', 'scripts'], function() {
    gulp.watch(['*.html'], ['html']);
    gulp.watch(['assets/js/vendor/*.js','assets/js/partials/*.js'], ['scripts']);
    gulp.watch(['assets/css/**/*.scss'], ['styles']);
});


// TODO - Add image compression
// TODO - Add image tracking
// TODO - Add publish feature
// TODO - Add source mapping for css and js
// TODO - Add autoprefixer to css compiling
