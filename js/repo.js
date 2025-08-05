fetch('json/repo.json')
  .then(res => res.json())
  .then(apps => {
    const container = document.getElementById('app-list');
    apps.forEach(app => {
      const card = document.createElement('div');
      card.className = 'app-card';
      card.innerHTML = `
        <img src="${app.icon}" alt="${app.name}">
        <div class="app-info">
          <h2>${app.name}</h2>
          <p><strong>Bundle ID:</strong> ${app.bundle_id}</p>
          <p><strong>Version:</strong> ${app.version}</p>
          <a href="${app.download}">Download IPA</a>
        </div>
      `;
      container.appendChild(card);
    });
  })
  .catch(err => {
    console.error("Failed to load apps.json:", err);
    document.getElementById("app-list").innerHTML = "<p>Failed to load app list.</p>";
  });
