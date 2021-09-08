import gulp from 'gulp';
import autoprefixer from 'autoprefixer';
// import babel from 'gulp-babel';
// import browserSync from 'browser-sync';
// import combine from 'gulp-scss-combine';
import concat from 'gulp-concat';
import cssnano from 'gulp-cssnano';
// import eslint from 'gulp-eslint';
import postcss from 'gulp-postcss';
import print from 'gulp-print';
import sass from 'gulp-sass';
// import uglify from 'gulp-uglify';

const paths = {
	publicStyles: {
		src: 'sass/**/*.scss',
		dest: './'
	}
};

// Initialize Browser Sync
// const server = browserSync.create();

// function reload(done) {
// 	server.reload();
// 	done();
// }

// function serve(done) {
// 	server.init({
// 		proxy: '#',
// 		port: '8181'
// 	});
// 	done();
// }

/*
* You can also declare named functions and export them as tasks
*/
export function publicStyles() {
	return gulp.src(paths.publicStyles.src)
		.pipe(print())
		.pipe(sass({
			outputStyle: 'compresed',
			precision: 3,
			errLogToConsole: true
		}).on('error', sass.logError))
		.pipe(postcss([
			autoprefixer,
			cssnano
		]))
		//.pipe(combine())
		.pipe(concat('style.css'))
		.pipe(gulp.dest(paths.publicStyles.dest));
}

export function watch() {
	gulp.watch(paths.publicStyles.src, gulp.series(publicStyles));
}

// Run serve on first load, which also watches
const firstRun = gulp.series(publicStyles, watch);

/**
 * Run the whole thing.
 */
export default firstRun;
