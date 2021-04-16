const fs = require("fs");

module.exports = {
	transpileDependencies: ["vuetify"],
	pwa: {
		name: "Levelz",
		themeColor: "#209CEE",
		msTileColor: "#000000",
		appleMobileWebAppCapable: "yes",
		appleMobileWebAppStatusBarStyle: "209CEE",

		// configure the workbox plugin
		workboxPluginMode: "InjectManifest",
		workboxOptions: {
			// swSrc is required in InjectManifest mode.
			swSrc: "src/registerServiceWorker.js"
			// ...other Workbox options...
		},
		iconPaths: {
			favicon32: "img/icons/favicon-32x32.png",
			favicon16: "img/icons/favicon-16x16.png",
			appleTouchIcon: "img/icons/apple-touch-icon.png",
			maskIcon: "img/icons/safari-pinned-tab.svg",
			msTileImage: "img/icons/mstile-150x150.png"
		}
	},
	devServer: {
		https: {
			key: fs.readFileSync("./certs/localhost-key.pem"),
			cert: fs.readFileSync("./certs/localhost.pem")
		}
	}
};
