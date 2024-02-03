function loadUsers(groupId = null) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {groupId: groupId},
            url: "server.php?action=getUsers",
            success: function(data) {
                resolve(data) // Resolve promise and when success
            },
            error: function(err) {
                reject(err) // Reject the promise and go to catch()
            }
        });
    });
}

function getUser(userId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {userId: userId},
            url: "server.php?action=getUser",
            success: function(response) {
                resolve(response.data[0]) // Resolve promise and when success
            },
            error: function(err) {
                reject(err) // Reject the promise and go to catch()
            }
        });
    });
}

async function showUsers(tableId, groupId = null)
{
    console.log({groupId:groupId});

    const response = await loadUsers(groupId);
    var data = response.data;
    var userList = $("#" + tableId);
    userList.empty();
    userList.append(
        "<tr>" +
        "<th>User Name</th>" +
        "<th>Password</th>" +
        "<th>First Name</th>" +
        "<th>Last Name</th>" +
        "<th>Birth Date</th>" +
        (groupId == null ? "<th>Edit</th>" : "") +
        (groupId == null ? "<th>Delete</th>" : "") +
        (groupId != null ? "<th>Delete from group</th>" : "") +
        "</tr>"
    );

    $.each(data, function (index, user) {
        userList.append(
            "<tr>" +
            "<td>" + user.username + " </td> " +
            "<td><input type='password' class='password' value='" + user.password + "'></input> <button class='btn-show-hide' onclick='showPassword(this)'>👁️</button></td> " +
            "<td>" + user.first_name + " </td>" +
            "<td>" + user.last_name + " </td> " +
            "<td>" + user.birth_date + " </td> " +
            (groupId == null ? "<td><button onclick='editUser(" + user.id + ")'>Edit</button> " + "</td>" : "") +
            (groupId == null ? "<td><button class='trash' onclick='removeUser(" + user.id + ")'>🗑</button>" : "")+ "</td>"  +
            (groupId != null ? "<td><button class='trash' onclick='removeUserFromGroup(" + user.id + "," + groupId + ")'>🗑</button>" : "")+ "</td>"  +
            "</tr>");
    });
}

function addUser() {
    var username = $("#username").val();
    var password = $("#password").val();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var birthDate = $("#birthDate").val();

    $.post("server.php?action=addUser", {
        username: username,
        password: password,
        firstName: firstName,
        lastName: lastName,
        birthDate: birthDate
    }, function () {
        showUsers('userList');
    });
}

function removeUser(id) {
    let modal = document.getElementById("confirmDialog");
    modal.showModal();

    $('#confirmBtn').click(function(){
        modal.close();
        $.post("server.php?action=removeUser", {id: id}, function () {
            showUsers('userList');
        });
        id = null;
    });
}

async function editUser(id) {
    let modal = document.getElementById("editUserDialog");

    let user = await getUser(id);
    let groups = await getGroups();
    let userInGroups = await getUserGroups(user.id);
    modal.showModal();

    $("#usernameNew").val(user.username).trigger('change');
    $("#passwordNew").val(user.password).trigger('change');
    $("#firstNameNew").val(user.first_name).trigger('change');
    $("#lastNameNew").val(user.last_name).trigger('change');
    $("#birthDateNew").val(user.birth_date).trigger('change');
    $("#userId").val(user.id).trigger('change');
    $('#groupsSelect').empty();
    $.each(groups.data, function (i, item) {
        $('#groupsSelect').append($('<option>', {
            value: item.id,
            text : item.group_name
        }))
    });
    $("#alreadyInGroups").empty();
    $.each(userInGroups, function (i, item) {
        $("#alreadyInGroups").append("<li>" + item.group_name + "</li>").trigger('change')
    });

}

function getUserGroups(userId)
{
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {userId: userId},
            url: "server.php?action=getUserGroups",
            success: function(response) {
                resolve(response.data) // Resolve promise and when success
            },
            error: function(err) {
                reject(err) // Reject the promise and go to catch()
            }
        });
    });
}

function editUserPost() {
    var userId = $("#userId").val();
    var userName = $("#usernameNew").val();
    var password = $("#passwordNew").val();
    var firstName = $("#firstNameNew").val();
    var lastName = $("#lastNameNew").val();
    var birthDate = $("#birthDateNew").val();

    $.post("server.php?action=editUser", {
        userId: userId,
        userName: userName,
        password: password,
        firstName: firstName,
        lastName: lastName,
        birthDate: birthDate
    }, function () {
        showUsers('userList');
    });

    document.getElementById("editUserDialog").close();
}

function addUserToGroup()
{
    let userId = $("#userId").val();
    let groupId = $("#groupsSelect").val();

    $.post("server.php?action=addUserToGroup", {
        userId: userId,
        groupId: groupId,
    }, function () {
        editUser(userId);
    });
}

function getGroup(groupId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {groupId: groupId},
            url: "server.php?action=getGroup",
            success: function(response) {
                resolve(response.data[0]) // Resolve promise and when success
            },
            error: function(err) {
                reject(err)
            }
        });
    });
}

function getGroups() {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "server.php?action=getGroups",
            success: function(data) {
                resolve(data) // Resolve promise and when success
            },
            error: function(err) {
                reject(err)
            }
        });
    });
}
function loadGroups() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "server.php?action=getGroups",
        success: function( response )
        {
            var groupList = $("#groupList");
            groupList.empty();
            groupList.append(
                "<tr>" +
                "<th>Group Name</th>" +
                "<th>Users Count</th>" +
                "<th>Edit</th>" +
                "<th>Show Users</th>" +
                "<th>Delete</th>" +
                "</tr>"
            );
            $.each(response.data, function (index, group) {
                groupList.append("<tr>" +
                    "<td>" + group.group_name + " </td> " +
                    "<td>" + group.memberCount + " </td> " +
                    "<td>" +
                    "<button onclick='editGroup(" + group.id + ")'>Edit</button> " + "</td>" +
                    "<td>" +
                    "<button onclick='showUsers( \"usersInGroup"+ "\"," + group.id + ")'>Show Users</button> " + "</td>" +
                    "<td>" +
                    "<button class='trash' onclick='removeGroup(" + group.id + ")'>🗑</button>" + "</td>" +
                    "</tr>");
            });

        },
        error: function( error )
        {
            alert( error );
        }
    });
    $("#usersInGroup").empty();
}

function addGroup() {
    var groupname = $("#groupName").val();

    $.post("server.php?action=addGroup", {
        groupname: groupname,
    }, function () {
        loadGroups();
    });
}

function removeGroup(id) {
    let modal = document.getElementById("confirmDialog");
    modal.showModal();
    console.log('remove group ' + id);
    $('#confirmBtn').click(function(){
        modal.close();
        $.post("server.php?action=removeGroup", {id: id}, function () {
            loadGroups();
        });
    });
}
async function editGroup(groupId) {
    let editGroupDialog = document.getElementById("editGroupDialog");
    editGroupDialog.showModal();
    let group = await getGroup(groupId);
    $("#groupId").val(groupId).trigger('change');
    $("#groupnameNew").val(group.group_name).trigger('change');
}

function editGroupPost() {
    let groupName = $("#groupnameNew").val();
    let groupId = $("#groupId").val();
    console.log(groupId)
    $.post("server.php?action=editGroup", {groupId: groupId, groupName: groupName}, function () {
        loadGroups();
    });
}

function removeUserFromGroup(userId, groupId) {
    let modal = document.getElementById("confirmDialog");
    modal.showModal();

    $('#confirmBtn').click(function(){
        modal.close();
        $.post("server.php?action=removeUserFromGroup", {userId: userId, groupId:groupId}, function () {
            loadGroups();
        });
        loadGroups();
        showUsers("usersInGroup", groupId);
        id = null;
    });
}
