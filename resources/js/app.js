// if (window.EventSource) {
//   const source = new EventSource('');

//   source.addEventListener('newProject', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   source.addEventListener('proposalAccepted', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   source.addEventListener('proposalDeclined', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   source.addEventListener('newProposal', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   source.addEventListener('newMessage', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   source.addEventListener('newFile', function (event) {
//     const data = JSON.parse(event.data);
//     displayNotification(data.message);
//   });

//   function displayNotification(message) {
//     const notificationDiv = document.createElement('div');
//     notificationDiv.textContent = message;
//     document.getElementById('notifications').appendChild(notificationDiv);
//   }
// } else {
//   console.error("Your browser doesn't support SSE.");
// }
