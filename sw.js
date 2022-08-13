const version = '2';
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(`static-${version}`)
        .then(cache => Promise.all(
            [
                '/light.css',
                '/dark.css',
                'https://raw.thun888.xyz/thun888/asstes/master/files/Bili_Realtime_Data/digit.ttf',
                'https://raw.thun888.xyz/thun888/asstes/master/files/Bili_Realtime_Data/bili.ico'
            ].map(url => {
                // cache-bust using a random query string
                return fetch(`${url}?${Math.random()}`).then(response => {
                    // fail on 404, 500 etc
                    if (!response.ok) throw Error('Not ok');
                    return cache.put(url, response);
                })
            })
        ))
    );
});
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
        .then(response => response || fetch(event.request))
    );
});
