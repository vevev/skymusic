<template>
    <div id="audio-player-container" :class="{ errorMessage: error }">
        <div :class="{ player: true, canplay: canplay }">
            <div class="btn-play" v-if="isPause" @click="onClickPlayBtn"></div>
            <div class="btn-pause" v-if="isPlay" @click="onClickPauseBtn"></div>
            <div class="currentText">{{ currentText }}</div>
            <div ref="progress-bar" class="progress-bar" @click="onCLickProgressBar">
                <div class="buffered" v-bind:style="bufferedStyle"></div>
                <div class="current" v-bind:style="currentStyle"></div>
            </div>
            <div class="durationText">{{ durationText }}</div>
            <div class="volume-group">
                <div class="volume-bar" @click="onClickVolumeBar">
                    <div class="currentVolume" v-bind:style="currentVolume"></div>
                </div>
                <div class="btn-muted" v-if="muted" @click="onClickMutedBtn"></div>
                <div class="btn-volume" v-if="!muted" @click="onClickVolumeBtn"></div>
            </div>
        </div>
        <iframe
            width="auto"
            height="auto"
            scrolling="no"
            frameborder="no"
            allow="autoplay"
            ref="scplayer"
        ></iframe>
    </div>
</template>
<script type="text/javascript">
require('../../protos/String');
export default {
    data() {
        return {
            SC_Player: null,
            isPlay: false,
            volume: 30,
            muted: false,
            buffered: 0,
            canplay: 0,
            loadiframe: false,
            currentTime: 0,
            duration: 0,
            error: false,
            progressBarEloffsetWidth: null,
        };
    },

    props: {
        ids: 0,
    },

    mounted() {
        this.$refs.scplayer.src = this.src;
        this.SC_Player = SC.Widget(this.$refs.scplayer);
        this.initAudioEvent();
    },

    watch: {
        isPlay(newValue, oldValue) {
            if (newValue) {
                this.SC_Player.play();
            } else if (oldValue) {
                this.SC_Player.pause();
            }
        },

        muted(n, o) {
            if (n) {
                this.SC_Player.setVolume(0);
            } else if (o) {
                this.SC_Player.setVolume(this.volume);
            }
        },

        volume(n, o) {
            this.SC_Player.setVolume(n);
        },
    },

    computed: {
        src() {
            return (
                'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' +
                this.ids +
                '&color=%23ff5500&auto_play=false&hide_related=false&show_comments=false&show_user=false&show_reposts=false&show_teaser=false'
            );
        },

        isPause: function() {
            return !this.isPlay;
        },

        currentPercent: function() {
            return (100 * this.currentTime) / this.duration;
        },

        currentStyle: function() {
            return { width: this.currentPercent + '%' };
        },

        bufferedStyle: function() {
            return { width: this.buffered + '%' };
        },

        currentVolume: function() {
            return { width: this.volume + '%' };
        },

        currentText() {
            return this.secondToTime(this.currentTime);
        },

        durationText() {
            return this.secondToTime(this.duration);
        },
    },

    methods: {
        secondToTime(second) {
            var date = new Date(null);
            date.setSeconds(second);
            return date
                .toISOString()
                .substr(11, 8)
                .replace(/(?:00:)+(\d{2}\:\d{2})/g, '$1');
        },

        initAudioEvent() {
            let self = this;
            this.SC_Player.bind(SC.Widget.Events.READY, () => {
                this.SC_Player.getCurrentSound(sound => {
                    if (!sound.streamable) {
                        this.isPlay = false;
                        this.canplay = false;
                        this.error = true;
                    } else {
                        this.canplay = 1;
                        this.volume++;
                        this.progressBarEloffsetWidth = this.$refs['progress-bar'].offsetWidth;
                    }
                });

                this.SC_Player.getDuration(val => {
                    this.duration = val / 1000;
                });

                this.SC_Player.bind(SC.Widget.Events.PLAY_PROGRESS, e => {
                    this.currentTime = e.currentPosition / 1000;
                    this.buffered = e.loadedProgress * 100;
                });

                this.SC_Player.bind(SC.Widget.Events.LOAD_PROGRESS, e => {
                    //console.log('loading');
                });

                this.SC_Player.bind(SC.Widget.Events.PLAY, e => {
                    //this.SC_Player.pause();
                });

                this.SC_Player.bind(SC.Widget.Events.FINISH, e => {
                    this.isPlay = false;
                });

                this.SC_Player.bind(SC.Widget.Events.ERROR, e => {
                    this.isPlay = false;
                    this.canplay = false;
                    this.error = true;
                });
            });
        },

        onCLickProgressBar(event) {
            this.currentTime = (event.offsetX * this.duration) / this.progressBarEloffsetWidth;
            this.SC_Player.seekTo(this.currentTime * 1000);
            !this.isPlay && this.SC_Player.pause();
        },

        onClickPauseBtn(event) {
            this.isPlay = false;
        },

        onClickPlayBtn(event) {
            if (this.canplay) {
                this.isPlay = true;
            }
        },

        onClickVolumeBar(event) {
            this.volume = event.offsetX;
        },

        onClickVolumeBtn(event) {
            this.muted = true;
        },

        onClickMutedBtn(event) {
            this.muted = false;
        },
    },
};
</script>
<style type="text/css" lang="scss" scoped>
div#audio-player-container {
    overflow: hidden;
    display: flex;
    flex: 1;
    background: #f1f3f4;
    height: 27px;
    border-radius: 3px;
    position: relative;
    iframe {
        z-index: -1;
        position: absolute;
        opacity: 0;
    }
    .player {
        display: flex;
        background: #f1f3f4;
        height: 27px;
        align-items: center;
        padding: 0px 0px;
        margin-top: 27px;
        width: 100%;
        position: relative;
        transition: all 0.5s ease-in-out;

        &:before {
            width: 100%;
            height: 100%;
            top: -100%;
            content: 'LOADING ... ';
            font-size: 15px;
            font-family: monospace;
            font-size: 12px;
            font-weight: bold;
            color: #444;
            justify-content: center;
            align-items: center;
            position: absolute;
            display: flex;
        }

        .currentText,
        .durationText {
            font-size: 13px;
            font-family: sans-serif;
        }
        .currentText {
            margin-right: 10px;
        }
        .durationText {
            margin-left: 10px;
        }
        .progress-bar {
            height: 100%;
            flex-grow: 1;
            margin: 0;
            background: transparent;
            position: relative;
            &:before {
                content: '';
                background: #c1c3c3;
                width: 100%;
                height: 4px;
                display: block;
                position: absolute;
                border-radius: 5px;
                top: 50%;
                transform: translateY(-50%);
            }
            .buffered,
            .current {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                height: 4px;
                border-radius: 5px;
            }

            .buffered {
                background: #757575;
            }
            .current {
                background: #0b0b0b;
            }
        }
        .btn-muted,
        .btn-play,
        .btn-pause,
        .btn-volume {
            &:before {
                content: '';
                width: 15px;
                height: 100%;
                display: block;
            }
        }
        .btn-play {
            padding: 0 10px 0 5px;
            height: 100%;
            &:before {
                background-image: url('/svg/play.svg');
            }
        }
        .btn-pause {
            padding: 0 10px 0 5px;
            height: 100%;
            &:before {
                background-image: url('/svg/pause.svg');
            }
        }
        .btn-muted {
            height: 100%;
            padding-left: 10px;
            padding-right: 5px;
            &:before {
                background-image: url('/svg/muted.svg');
            }
        }
        .btn-volume {
            height: 100%;
            padding-left: 10px;
            padding-right: 5px;
            &:before {
                background-image: url('/svg/volume.svg');
            }
        }

        .volume-group {
            display: flex;
            width: 30px;
            height: 100%;
            align-items: center;
            transition: all 0.5s ease-in-out;
            overflow: hidden;
            &:hover {
                width: 120px;
                margin-left: 10px;
                border-top-left-radius: 5px;
                border-bottom-left-radius: 5px;
            }

            .volume-bar {
                width: 100px;
                height: 100%;
                align-self: center;
                position: relative;

                &:before {
                    content: '';
                    height: 4px;
                    display: block;
                    position: absolute;
                    width: 100%;
                    top: 50%;
                    left: 0;
                    -webkit-transform: translateY(-50%);
                    transform: translateY(-50%);
                    background: #c1c3c3;
                    border-radius: 5px;
                }

                .currentVolume {
                    height: 4px;
                    top: 50%;
                    left: 0;
                    transform: translateY(-50%);
                    position: absolute;
                    background: #0b0b0b;
                    z-index: 100;
                }
            }
        }
    }
    .canplay {
        margin-top: 0 !important;
    }
}
.errorMessage {
    &:before {
        content: "Error, Can't Play Audio !";
        height: 100%;
        width: 100%;
        font-size: 13px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        z-index: 1;
        background: #000000;
    }
}
</style>
