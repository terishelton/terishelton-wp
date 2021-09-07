'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

const paths = {
	styles: {
		src: 'sass/**/*.scss',
		dest: 'sass'
	}
};

function buildStyles() {
	return gulp.src(paths.styles.src)
		.pipe(sass.sync({outputStyle: 'compressed'}).on('error', sass.logError))
		.pipe(gulp.dest('/style.css'));
};

exports.buildStyles = buildStyles;
exports.watch = function () {
	gulp.watch(paths.styles.src, ['sass']);
};

const build = gulp.series(clean, gulp.parallel(styles, scripts));
exports.build = build;

exports.default = build;
