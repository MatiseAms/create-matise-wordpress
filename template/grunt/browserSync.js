module.exports = {
	dev: {
		options: {
			files: ['public/content/themes/**/*.*'],
			proxy: '<%= name %>.matise',
			watchTask: true
		}
	}
};
