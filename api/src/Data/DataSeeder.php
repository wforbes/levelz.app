<?php

namespace Data;

use User\User;
use Role\Role;
use Permission\Permission;

class DataSeeder {
	//TODO: mock up initial data
	public function __construct($app) {
		$this->app = $app;
		include "passwordList.php";
		$this->creds = $getUserCredentialList();

		$this->user = new User($this->app);
		$this->role = new Role($this->app);
		$this->permission = new Permission($this->app);
	}

	public function seedRequired() {
		return !$this->user->userExistsByName("developer") 
			|| !$this->user->userExistsByName("wizard");
	}

	public function seedData() {
		// Create Users
		$wizardUserId = $this->createAndGetUserId("wizard");
		$developerUserId = $this->createAndGetUserId("developer");

		// Verify Users
		$this->user->verifyUser($wizardUserId);
		$this->user->verifyUser($developerUserId);

		//	Create Roles
		$wizardRoleId = $this->role->createNewRole("wizard", 0)["roleId"];
		$developerRoleId = $this->role->createNewRole("developer", 1)["roleId"];
		$this->role->createNewRole("moderator", 2);
		$this->role->createNewRole("user", 3);
		$this->role->createNewRole("deactivated", 4);
		$this->role->createNewRole("banned", 5);

		// Create UserRoles
		$this->role->setUserRole($wizardUserId, $wizardRoleId);
		$this->role->setUserRole($developerUserId, $developerRoleId);

		//Create Permissions and RolePermissions
		$routeToWizardPagePermissionId = $this->permission->createNewPermission("route", "wizard_page")["permissionId"];
		$this->permission->setRolePermission($wizardRoleId, $routeToWizardPagePermissionId);

		$routeToDeveloperPagePermissionId = $this->permission->createNewPermission("route", "developer_page")["permissionId"];
		$this->permission->setRolePermission($developerRoleId, $routeToDeveloperPagePermissionId);
		$this->permission->setRolePermission($wizardRoleId, $routeToDeveloperPagePermissionId);
	}

	private function createAndGetUserId($username) {
		if($this->user->userExistsByName($username)) {
			return $this->user->getIdByUsername($username);
		} else {
			return $this->user->createNewUser(
				$username,
				$this->creds[$username]["password"],
				$this->creds[$username]["email"]
			);
		}
	}

	private function getUserId($username) {
		return $this->user->getIdByUsername($username);
	}

	private function createUser($username) {
		$password = $this->creds[$username]["password"];
		$email = $this->creds[$username]["email"];
		return $this->user->createNewUser($username, $password, $email);
	}

	private function userExists($username) {
		return $this->user->userExistsByName($username);
	}

	//	Create RolePermissions table
	//	RolePermissions
	//		id
	//		roleId
	//		permissionId

	//	Create Permission table
	//	Permission
	//		id
	//		action
	//		object
	//	createNewPermission("route", "wizard_page")
	//	$roleId = getRoleIdByName("wizard");
	//	$permissionId = getPermissionId("route", "wizard_page")
	//	setRolePermission($roleId, $permissionId)

	// createNewPermission("route", "dev_page")
	//	$roleId = getRoleIdByName("dev");
	//	$permissionId = getPermissionId("route", "dev_page")
	//	setRolePermission($roleId, $permissionId)

	// createNewPermission("create", "permission")
	// createNewPermission("read", "permission")
	// createNewPermission("update", "permission")
	// createNewPermission("delete", "permission")
	// createNewPermission("create", "user")
	// createNewPermission("read", "user")
	// createNewPermission("update", "user")
	// createNewPermission("delete", "user") - allow for deactivating a user from the database
		

	
		
}