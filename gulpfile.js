var gulp 		= require('gulp');
var sass 		= require('gulp-sass');
var jshint		= require('gulp-jshint');
var concat		= require('gulp-concat');
var imagemin	= require('gulp-imagemin');
var rename 		= require('gulp-rename');
//gulp-plumber to handle errors in our tasks
var plumber 	= require('gulp-plumber');
//gulp-notify to show a nice growl life notifications upon error
var notify 		= require('gulp-notify');

//js compression
var uglify 		= require('gulp-uglify');
var pump 		= require('pump');

// css compression
// var minifyCSS 	= require('gulp-minify-css');
var cleanCSS = require('gulp-clean-css');

//for server and live reload, use gulp connect -- not being used anymore, doenst work with php
// connect = require('gulp-connect');

var browserSync = require('browser-sync');
var reload  	= browserSync.reload;

//Here is a handy plumber setting that we will use when an error occurs in any of the tasks
var plumberErrorHandler = { errorHandler: notify.onError({
 
    title: 'Gulp',
 
    message: 'Error: <%= error.message %>'
 
  })
 
};

//compile sass
gulp.task('sass', function(){

	var sourceSass = [
		'css/main.scss',
	];

	gulp.src( sourceSass )
		.pipe( plumber( plumberErrorHandler ) )
		.pipe( sass() )
		.pipe( rename('main.css') )
		.pipe( gulp.dest('css') )
		.pipe( reload({stream:true}) );
        
});

//minify and combine js
gulp.task('js', function(){

	var needScripts = [
		'js/src/libraries/jquery-3.1.1.min.js',
		'js/src/libraries/bootstrap.min.js',
		'js/src/*.js',
		// 'js/src/skip-link-focus-fix.js',
		// 'js/src/navigation.js',
		// 'js/src/googleMapOverride.js',
	];
	// gulp.src('js/src/**/*.js')
	gulp.src( needScripts )
		.pipe( plumber( plumberErrorHandler ) )
		.pipe( jshint() )
			.pipe(jshint.reporter('fail'))
			.pipe( concat('main.js') )
			.pipe( gulp.dest('js') )
			.pipe( reload({stream:true}) );
});

// browser-sync task for starting the server.
gulp.task('browser-sync', function() {
    //watch files
    var files = [
        './css/main.css',
	    './style.css',
	    './*.php'
    ];
 
    //initialize browsersync
    browserSync.init(files, {
	    //browsersync with a php server
	    // proxy: "http://localhost:8888/patellinis/",
		proxy: "localhost/patellinis",
	    notify: false
    });
});

//setting up a watch for automating tasks
gulp.task('watch', function(){

	gulp.watch('css/**/*.scss', ['sass'] );

	gulp.watch('js/src//*.js', ['js'] );

    // gulp.watch( 'img/src/*.{png, jpg, gif}', ['img'] );

	gulp.watch('**/*.php', function(){
		 browserSync.reload();
	})

});

gulp.task('build', function(){

	var themeName = "patellinis";

	var webFiles = [
		'**/*.php',
		'!build/',
		'!build/**',
		'!node_modules/',
		'!node_modules/**',
		'style.css',
		'*.png',
		'**/img/*.*',
		'**/font-awesome-4.7.0/css/*.*',
		'**/fonts/**/*.*',
		'**/patellinis-bootstrap/**/*.*',
		'**/languages/*.*'
	];

	gulp.src( webFiles )
		.pipe( gulp.dest( 'build/' + themeName ) );

	pump([
		gulp.src('js/main.js'),
		uglify(),
		gulp.dest( 'build/' + themeName + '/js' )
	]);

	pump([
		gulp.src('css/**/*.css'),
		cleanCSS({compatibility: 'ie8'}),
		gulp.dest( 'build/' + themeName + '/css' )
	]);

});

gulp.task('default', [ 'sass', 'js', 'browser-sync', 'watch' ] );