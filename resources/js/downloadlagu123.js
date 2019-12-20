require('./bootstrap');

const Lyric = require('./components/downloadlagu123/show-song-lyric').default;
const Search = require('./components/downloadlagu123/form-search').default;
const AudioPlayer = require('./components/downloadlagu123/audio-player-default').default;
const AudioPlayerPlaylist = require('./components/downloadlagu123/audio-player-playlist-default')
    .default;
const ButtonDownload = require('./components/downloadlagu123/button-download-default').default;
const LoadMoreSearchSong = require('./components/downloadlagu123/load-more-search-song').default;
var vm = null;

if ((vm = document.getElementById('lyric'))) {
    const app = new Vue({
        el: '#lyric',
        data: {
            lyric: vm.dataset.lyric,
        },
        components: { lyric: Lyric },
        template: `<lyric :lyric="lyric"> </lyric>`,
    });
}

if ((vm = document.getElementById('search-form'))) {
    const searchFrom = new Vue({
        el: '#search-form',
        data: {
            action: vm.attributes.action.value,
            query: vm.attributes.query.value,
            suggestRoute: vm.attributes['suggest-route'].value,
        },
        components: { 'search-form': Search },
        template: `<search-form :action="action" :query="query" :suggest-route="suggestRoute"> </search-form>`,
    });
}

if ((vm = document.getElementById('button-download-container'))) {
    const buttonDownload = new Vue({
        el: '#button-download-container',
        data: {
            href: vm.dataset.href,
            download: vm.dataset.download,
        },
        components: { ButtonDownload },
        template: `<ButtonDownload :href="href" :download="download"></ButtonDownload>`,
    });
}

if ((vm = document.getElementById('audio-player-container'))) {
    const audioPlayer = new Vue({
        el: '#audio-player-container',
        data: { src: vm.dataset.src, retry: vm.dataset.retry },
        components: { AudioPlayer },
        template: `<AudioPlayer :src="src" :retry="retry"></AudioPlayer>`,
    });
}

if ((vm = document.getElementById('playlist-container'))) {
    const audioPlayerPlaylist = new Vue({
        el: '#playlist-container',
        data: {
            src: vm.dataset.src,
            songs: JSON.parse(vm.dataset.songs),
            playlistid: vm.dataset.playlistid,
        },
        components: { AudioPlayerPlaylist },
        template: `<AudioPlayerPlaylist :src="src" :prop-songs="songs" :playlistid="playlistid"></AudioPlayerPlaylist>`,
    });
}

if ((vm = document.getElementById('load-more-result'))) {
    const loadMoreSearchSong = new Vue({
        el: '#load-more-result',
        data: {
            query: vm.dataset.query,
            api: vm.dataset.api,
        },
        components: { LoadMoreSearchSong },
        template: `<LoadMoreSearchSong  :query="query" :api="api"> </LoadMoreSearchSong>`,
    });
}

const view_more_elements = document.getElementsByClassName('collapse-view-more');
[].slice.call(view_more_elements).map(e =>
    e.addEventListener('click', function(e) {
        e.target.parentElement.classList.add('expand');
    })
);

const loadImage = img => {
    img.setAttribute('src', img.dataset.src);
    img.dataset.loaded = true;
};

const lazyLoadImage = thumb => {
    new IntersectionObserver(e => {
        var img = e[0].target.querySelector('img');
        if (e[0].isIntersecting && !img.dataset.loaded) {
            loadImage(img);
        }
    }).observe(thumb);
};

document.addEventListener('DOMContentLoaded', event => {
    var lazyLoad = 0,
        thumbs = document.getElementsByClassName('thumb');
    if ('IntersectionObserver' in window) lazyLoad = 1;
    [].slice.call(thumbs).forEach(thumb => {
        lazyLoad ? lazyLoadImage(thumb) : loadImage(thumb.querySelector('img'));
    });
});
