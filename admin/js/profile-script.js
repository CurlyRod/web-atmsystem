const fullName = document.getElementById('fullName').textContent;
const [firstName, , lastName] = fullName.split(' '); // Using array destructuring to skip the middle name
const initials = firstName[0] + lastName[0];
document.getElementById('profileImage').innerHTML = initials.toUpperCase();