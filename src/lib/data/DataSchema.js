export default class DataSchema {
	static activitySchema = {
		name: "activities",
		fields: [
			{
				name: "id",
				type: "guid"
			},
			{
				name: "name",
				type: "string"
			},
			{
				name: "description",
				type: "string"
			}
		]
	};

	static activitySchema = {
		name: "actions",
		fields: [
			{
				name: "id",
				type: "guid"
			},
			{
				name: "name",
				type: "string"
			},
			{
				name: "description",
				type: "string"
			}
		]
	};

	static findFieldValue(data, fieldName) {
		return data.fields.find(field => {
			return field.name === fieldName;
		}).value;
	}

	static getFieldNames(schema) {
		let returnArr = [];
		for (let field of schema.fields) {
			returnArr.push(field.name);
		}
		return returnArr;
	}
}
