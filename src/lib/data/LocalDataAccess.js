import { openDB } from "idb";
//import U from "../util/U.js";

export default class LocalDataAccess {
	da;
	db;
	dbName = "Lvlz";
	initalized;

	init() {
		return new Promise((resolve, reject) => {
			(async () => {
				try {
					await this.setup();
					resolve("done");
				} catch (error) {
					reject(error);
				}
			})();
		});
	}

	async setup() {
		let upgraded = false;
		let currentVersion = 1;
		this.db = await openDB(this.dbName, currentVersion, {
			upgrade(db, oldVer, newVer /*, transaction*/) {
				/* Creating an object store
				const testOS = db.createObjectStore("testStore", {
					keyPath: "TestID"
				});
				testOS.createIndex("TestID", "TestID", {
					unique: true
				});
				*/
				//db.deleteObjectStore("testStore"); //deleting an object store
				//Checking if object store exists
				//	if (transaction.objectStoreNames.contains("TTDemoUsers")) {}
				/* Iterating through existing store */
				/*const store = transaction.objectStore("TTDemoUsers");
				const objects = await store.getAll();
				console.log(objects);
				let cursor = await store.openCursor();
				while (cursor) {
					console.log(cursor.key, cursor.value);
					cursor = await cursor.continue();
				}*/
				const usersOS = db.createObjectStore("users", { keyPath: "id" });
				usersOS.createIndex("id", "id", { unique: true });
				usersOS.createIndex("email", "email", { unique: true });
				usersOS.createIndex("username", "username", { unique: true });

				if (oldVer === 0) {
					console.log("installed Lvlz local db");
				}

				if (newVer === 2) {
					console.log("new version is 2");
				}
				
				upgraded = true;
			},
			blocked() {
				console.log("idb: blocked");
			},
			blocking() {
				console.log("idb: blocking");
			},
			terminated() {
				console.log("idb: terminated");
			}
		})
			.catch(async error => {
				console.log("IDB version mismatch found.");
				if (error.name === "VersionError") {
					if (!("indexedDB" in window)) {
						window.indexedDB =
							window.indexedDB ||
							window.mozIndexedDB ||
							window.webkitIndexedDB ||
							window.msIndexedDB;
					}
					if (typeof window.indexedDB.databases !== "function") {
						console.log(
							//As of v83, Firefox doesn't support indexedDB.databases()
							"Unable to repair local " +
								this.dbName +
								" database, please delete it manually and try again."
						);
						return;
					}
					const dbs = await window.indexedDB.databases();
					const lvlzdb = dbs.find(db => db.name === this.dbName);
					console.log(lvlzdb);
				}
			})
			.then(async db => {
				if (upgraded) {
					await this.seedData(db);
				}
				return db;
			});
	}

	async seedData(db) {
		//console.log("seeding data");
		await db.add("users", {
			id: 1,
			email: "will@lvlz.app",
			username: "wforbes"
		});
		return Promise.resolve();
	}
}
