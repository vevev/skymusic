<template>
    <div id="playlist-container">
        <audio
            controls
            preload="none"
            @error="onError"
            v-on:pause="onPause"
            v-on:play="onPlay"
            v-on:ended="onEnded"
            ref="audio"
        >
            Trình duyệt của bạn không hỗ trợ nghe online !
        </audio>
        <div id="songs-container">
            <div
                v-for="(song, i) in songs"
                :class="{ song: true, songplay: song.play }"
                @click.stop="onCLickMenu(i)"
            >
                <div class="status">
                    <div class="playing icon-play" v-if="!song.play"></div>
                    <div class="pause icon-pause" v-if="song.play"></div>
                </div>
                <div class="info">
                    <h3 class="name">
                        <a :href="song.detail_url" :title="title(song.name)">
                            {{ song.name }}
                        </a>
                    </h3>
                    <span class="sg">
                        <b class="single">{{ song.single }}</b>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script type="text/javascript">
export default {
    data() {
        return {
            number_request: 0,
            MAX_NUMBER_REQUEST: 2,
            index: 0,
            audio_src: null,
            songs: Array,
            locations: null,
        };
    },

    props: {
        playlist: String,
        propSongs: Array,
    },

    methods: {
        title(name) {
            return `Download Mp3 ${name}`;
        },

        async onCLickMenu(index) {
            this.index = index;

            if (!this.locations) {
                let res = await axios.get(this.playlist);
                if (res.data.length) this.locations = res.data;
            }

            this.locations.map(
                function(location) {
                    if (location.id == this.songs[index].song_id) {
                        this.$refs.audio.pause();
                        this.$refs.audio.src = location.url;
                        this.$refs.audio.load();
                        this.$refs.audio.play();
                    }
                }.bind(this)
            );
        },

        onPlay() {
            this.$set(this.songs[this.index], 'play', true);
        },

        onPause() {
            this.$set(this.songs[this.index], 'play', false);
        },

        onEnded() {
            if (!this.songs[++this.index]) this.index = 0;
            this.$refs.audio.src = this.songs[this.index].detail_url
                .replace('tai-bai-hat-', 'listen/')
                .replace(/\/(.{12})\./, '.$1.');
            this.$refs.audio.load();
            this.$refs.audio.play();
        },

        async onError() {
            if (this.number_request >= this.MAX_NUMBER_REQUEST) return;
            this.number_request++;
            // try {
            //     //const response = await axios.post(this.audio_src, {}, { headers: { ReCache: 1 } });
            //     this.$refs.audio.load();
            //     this.$refs.audio.play();
            // } catch (e) {
            //     console.log(e);
            // }
        },
    },

    watch: {
        index(n, o) {
            this.$set(this.songs[o], 'play', false);
        },
    },

    created() {
        this.songs = this.propSongs.slice();
    },
};
</script>
<style type="text/css" lang="scss" scoped>
.song {
    display: flex;
    position: relative;
    height: 100%;
    padding: 10px 0;
    margin: 0 10px;
    overflow: hidden;
    border: none;
    border-bottom: 1px solid #ededed;
    transition: all 0.5s ease;

    .status {
        height: 40px;
        width: 40px;
        float: left;
        display: flex;
        .pause,
        .playing {
            display: flex;
            flex-grow: 1;
            &:before {
                height: 100%;
                width: 100%;
                justify-content: center;
                align-items: center;
                margin: 0;
                display: flex;
                font-size: 25px;
                color: #888;
            }
        }
        .pause {
        }
        .playing {
        }
    }
    .info {
        display: block;
        padding-bottom: 0;
        border: none;
        h3.name {
            font-size: 15px;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }
    &:after {
        content: '';
        display: block;
        clear: both;
    }
    &:before {
        content: '';
        display: flex;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }
}
.songplay {
    background: #ededed;
    .info {
        .name {
            a {
                color: red;
            }
        }
    }
}
</style>
