self.addEventListener('install', function(e) {
    self.skipWaiting();
});

self.addEventListener('activate', function(e) {
    return self.clients.claim();
});

self.addEventListener('fetch', function(e) {
    // Stratégie simple : réseau en priorité, pas de cache agressif pour l'instant
    e.respondWith(fetch(e.request));
});
