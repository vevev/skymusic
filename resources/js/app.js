require('./bootstrap');

const Lyric = require('./components/' + process.env.APP_TEMPLATE + 'show-song-lyric').default;
const Search = require('./components/' + process.env.APP_TEMPLATE + 'form-search').default;
const AudioPlayer = require('./components/' + process.env.APP_TEMPLATE + 'audio-player').default;
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

if ((vm = document.getElementById('audio-player-container'))) {
    const audioPlayer = new Vue({
        el: '#audio-player-container',
        data: { src: vm.dataset.src },
        components: { AudioPlayer },
        template: `<AudioPlayer :src="src"></AudioPlayer>`,
    });
}
