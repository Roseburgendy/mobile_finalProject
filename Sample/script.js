// Replace with your Firebase config
const firebaseConfig = {
  apiKey: "AIzaSyBjvcKLAhNJlw3xVtbgYNoEk8VqSNh342U",
    authDomain: "web-app-a25fa.firebaseapp.com",
    projectId: "web-app-a25fa",
    storageBucket: "web-app-a25fa.appspot.com",
    messagingSenderId: "96695350917",
    appId: "1:96695350917:web:7ce66ff49e21ab00625c5bc"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

// Save message to Firestore
function saveMessage() {
  const message = document.getElementById('messageInput').value;
  if (message.trim() !== "") {
    db.collection("messages").add({
      text: message,
      timestamp: new Date()
    }).then(() => {
      document.getElementById('messageInput').value = "";
      loadMessages();
    });
  }
}

// Load and display messages with Edit & Delete
function loadMessages() {
  const list = document.getElementById('messagesList');
  list.innerHTML = "";
  db.collection("messages").orderBy("timestamp", "desc").get().then(snapshot => {
    snapshot.forEach(doc => {
      const data = doc.data();
      const li = document.createElement('li');
      li.innerHTML = `
        ${data.text}
        <button onclick="editMessage('${doc.id}', '${data.text.replace(/'/g, "\\'")}')">Edit</button>
        <button onclick="deleteMessage('${doc.id}')">Delete</button>
      `;
      list.appendChild(li);
    });
  });
}

// Delete message
function deleteMessage(id) {
  db.collection("messages").doc(id).delete().then(() => {
    loadMessages();
  });
}

// Edit message
function editMessage(id, currentText) {
  const newText = prompt("Edit your message:", currentText);
  if (newText !== null && newText.trim() !== "") {
    db.collection("messages").doc(id).update({
      text: newText
    }).then(() => {
      loadMessages();
    });
  }
}

window.onload = loadMessages;
