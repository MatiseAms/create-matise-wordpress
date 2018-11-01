const superb = require('superb');
const axios = require('axios');

const rootDir = __dirname;

const salts = async () => {
	let response = await axios.get('https://api.wordpress.org/secret-key/1.1/salt');
	return response.data;
};

module.exports = {
	prompts: {
		name: {
			message: 'Project name',
			default: ':folderName:'
		},
		description: {
			message: 'Project description',
			default: `My ${superb.random()} Matise Wordpress project`
		},
		author: {
			message: 'Author name',
			type: 'string',
			default: ':gitUser:',
			store: true
		}
	},
	data() {
		return {
			salts: salts()
		};
	},
	skipInterpolation: [
		'grunt/browserSync.js',
		'grunt/browserify.js',
		'grunt/clean.js',
		'grunt/copy.js',
		'grunt/eslint.js',
		'grunt/webfont.js',
		'grunt/fontgen.js',
		'grunt/uglify.js',
		'grunt/watch.js'
	],
	move() {
		const moveable = {
			gitignore: '.gitignore',
			'_package.json': 'package.json',
			'_composer.json': 'composer.json'
		};

		return { ...moveable };
	},
	npmInstall: true,
	gitInit: true,
	post({ chalk, isNewFolder, folderName }) {
		const cd = () => {
			if (isNewFolder) {
				console.log(`    ${chalk.cyan('cd')} ${folderName}`);
			}
		};

		console.log();
		console.log(chalk.bold(`  To get started:\n`));
		cd();
		console.log(`    npm run dev\n`);
		console.log(chalk.bold(`  To build & start for production:\n`));
		cd();
		console.log(`    npm run staging`);
		console.log(`    cd dist`);
		console.log(`    npm i --production`);
		console.log(`    ./node_modules/.bin/nuxt start`);
		console.log();
	}
};
