module.exports = {
	root: true,
	env: {
		node: true
	},
	extends: ["plugin:vue/essential", "plugin:prettier/recommended",
	"eslint:recommended"],
	rules: {
		"no-console": process.env.NODE_ENV === "production" ? "error" : "off",
		"no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
		"indent": ["error", "tab"],
		"prettier/prettier": [
			"warn", {
				useTabs: true
			}
		]
	},
	parserOptions: {
		parser: "babel-eslint"
		}
	};
