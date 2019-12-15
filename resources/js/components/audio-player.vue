<template>
    <div id="audio-player-container" :class="{ errorMessage: error }">
        <div :class="{ player: true, canplay: canplay }">
            <div class="btn-play" v-if="isPause" @click="onClickPlayBtn"></div>
            <div class="btn-pause" v-if="isPlay" @click="onClickPauseBtn"></div>
            <div class="currentText">{{ currentText }}</div>
            <div ref="progress-bar" class="progress-bar" @click.stop.prevent="onCLickProgressBar">
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
    </div>
</template>
<script type="text/javascript">
require('../protos/String');
export default {
    data() {
        return {
            __audio__: null,
            isPlay: false,
            volume: 30,
            muted: false,
            buffered: 0,
            canplay: false,
            currentTime: 0,
            duration: 0,
            ratio: 0,
            error: false,
            progressBarEloffsetWidth: null,
        };
    },

    props: {
        src: String,
    },

    created() {
        this.__audio__ = new Audio(this.src);
        this.initAudioEvent();
    },

    mounted() {
        if (this.canplay) this.progressBarEloffsetWidth = this.$refs['progress-bar'].offsetWidth;
    },

    watch: {
        isPlay(newVal, oldVal) {
            if (newVal) {
                this.__audio__.play();
            } else if (oldVal) {
                this.__audio__.pause();
            }
        },

        muted(n, o) {
            this.__audio__.muted = n;
        },

        volume(n, o) {
            this.__audio__.volume = n / 100;
        },
    },

    computed: {
        isPause: function() {
            return !this.isPlay;
        },

        currentPercent: function() {
            return (100 * this.currentTime) / this.__audio__.duration;
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

            this.__audio__.addEventListener('canplay', function() {
                self.canplay = 1;
                self.duration = this.duration;
                self.ratio = self.progressBarEloffsetWidth / this.duration;
                self.volume++;
            });

            this.__audio__.addEventListener('timeupdate', function(e) {
                self.currentTime = this.currentTime;
                self.buffered = (100 * this.buffered.end(this.buffered.length - 1)) / this.duration;
            });

            this.__audio__.addEventListener('canplaythrough', function(e) {});

            this.__audio__.addEventListener('error', function(e) {
                self.isPlay = false;
                self.canplay = false;
                self.error = true;
            });

            this.__audio__.addEventListener('ended', function(e) {
                self.isPlay = false;
            });
        },

        onCLickProgressBar(event) {
            this.progressBarEloffsetWidth = this.$refs['progress-bar'].offsetWidth;
            this.ratio = this.progressBarEloffsetWidth / this.__audio__.duration;
            this.__audio__.currentTime = event.offsetX / this.ratio;
            !this.isPlay && this.__audio__.pause();
        },

        onClickPauseBtn(event) {
            this.isPlay = false;
        },

        onClickPlayBtn(event) {
            if (!this.canplay) return;

            this.isPlay = true;
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
            height: 4px;
            flex-grow: 1;
            margin: 0;
            background: #c1c3c3;
            border-radius: 5px;
            position: relative;
            .buffered,
            .current {
                position: absolute;
                height: 100%;
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
