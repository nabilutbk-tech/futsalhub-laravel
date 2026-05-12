self.addEventListener('install', (event) => {
    console.log('Service Worker: Installed');
});

self.addEventListener('fetch', (event) => {
    // Biarkan kosong untuk PWA basic. 
    // Ke depannya bisa diisi kode untuk mode Offline.
});
