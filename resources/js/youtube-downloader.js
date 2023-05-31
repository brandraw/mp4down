const all_mimes = {
    "audio/ac3": "ac3",
    "audio/ogg": "ogg",
    "video/ogg": "ogg",
    "application/ogg": "ogg",
    "video/3gpp2": "3g2",
    "video/3gp": "3gp",
    "video/3gpp": "3gp",
    "video/mp4": "mp4",
    "video/webm": "webm",
    "audio/x-m4a": "m4a",
    "video/x-f4v": "f4v",
    "video/x-flv": "flv",
    "video/webm": "webm",
    "audio/webm": "mp3",
    "audio/x-acc": "aac",
    "video/mpeg": "mpeg",
    "video/quicktime": "mov",
    "video/x-msvideo": "avi",
    "video/msvideo": "avi",
    "video/avi": "avi",
    "application/x-troff-msvideo": "avi",
    "video/x-sgi-movie": "movie",
    "audio/x-wav": "wav",
    "audio/wave": "wav",
    "audio/wav": "wav",

    "audio/mp4": "m4a",
    "audio/midi": "mid",
    "audio/x-aiff": "aif",
    "audio/aiff": "aif",
    "audio/x-pn-realaudio": "ram",
    "audio/x-pn-realaudio-plugin": "rpm",
    "audio/x-realaudio": "ra",
    "video/vnd.rn-realvideo": "rv",

    "audio/x-ms-wma": "wma",
    "audio/x-ms-wma": "wma",

}

function toHoursAndMinutes(totalSeconds) {
    let totalMinutes = Math.floor(totalSeconds / 60);

    let seconds = totalSeconds % 60;
    let hours = Math.floor(totalMinutes / 60);
    let minutes = totalMinutes % 60;

    if (hours < 10) {
        hours = '0' + hours;
    }

    if (minutes < 10) {
        minutes = '0' + minutes;
    }

    if (seconds < 10) {
        seconds = '0' + seconds;
    }

    return hours + ':' + minutes + ':' + seconds;
}

const downloadBtn = $('#download-btn');
downloadBtn.click(() => {
    const url = $("#download-url").val();
    if (url == '')
        return
    downloadBtn.html(`
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        `);
    $("#download-url").attr('disabled', true);
    downloadBtn.attr('disabled', true);


    $.post("youtube/get-youtube-info", {
        '_token': `${$('meta[name="csrf_token"]').attr('content')}`,
        'url': url
    }).done(res => {
        var data = `
        <div class="downloader-results-wrapper shadow">
            <h3 class="">${res.video_details.title}</h3>
            <div class="row">
                <div class="col-md-6 mb-2"><img src="${res.video_details.thumbnail.thumbnails.at(-1).url}" width="100%"
                        class="img-thumbnail" alt=""></div>
                <div class="col-md-6">
                    <div class=""><strong>Author: </strong>${res.video_details.author}</div>
                    <div class="text-truncate" data-toggle="tooltip" title="${res.video_details.shortDescription}"><strong>Description:
                        </strong>${res.video_details.shortDescription}</div>
                    <div class=""><strong>Duration: </strong>${toHoursAndMinutes(res.video_details.lengthSeconds)}</div>
                    <div class=''><h5>Recommeded:</h5>`;

        data += res.streaming_data.formats.map((v, k) => {
            return `<form action="/youtube/download-video" method="POST">
                        <input type="hidden" value="${$('meta[name="csrf_token"]').attr('content')}" name="_token">
                        <input type="hidden" value="${v.url}" name="url">
                        <input type="hidden" value="${all_mimes[v.mimeType.split(';')[0]]}" name="ext">
                        <input type="hidden" value="${res.video_details.title}" name="filename">
                        <button submit class="btn-success m-1 btn btn-large">Download ${v.mimeType.split(";")[0].split('/')[0]} (${(v.mimeType.split(';')[0].split('/')[0] == 'video') ? v.qualityLabel : v.audioQuality}) (${all_mimes[v.mimeType.split(';')[0]]})</button>
                    </form>`
        }).join('');
        data += `<div class=''>
            <div class="accordion" id="accordionDownload">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDownload">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDownload" aria-expanded="true" aria-controls="collapseDownload">
                                <h5>Additional Formats:</h5>                                    </button>
                        </h2>
                        <div id="collapseDownload" class="accordion-collapse collapse" aria-labelledby="headingDownload"
                            data-bs-parent="#accordionDownload">
                            <div class="accordion-body">
                    `
        data += res.streaming_data.adaptiveFormats.map((v, k) => {
            return `<form action="/youtube/download-video" method="POST">
                        <input type="hidden" value="${$('meta[name="csrf_token"]').attr('content')}" name="_token">
                        <input type="hidden" value="${v.url}" name="url">
                        <input type="hidden" value="${all_mimes[v.mimeType.split(';')[0]]}" name="ext">
                        <input type="hidden" value="${res.video_details.title}" name="filename">
                        <button submit class="btn-success m-1 btn btn-large">Download ${v.mimeType.split(";")[0].split('/')[0]} (${(v.mimeType.split(';')[0].split('/')[0] == 'video') ? v.qualityLabel : v.audioQuality}) (${all_mimes[v.mimeType.split(';')[0]]})</button>
                    </form>`
        }).join('');
        data += `               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;




        $("#download-result").html(data)
    }).fail((e) => {

    }).always(() => {
        downloadBtn.html(`
        <i class="bi bi-download me-2"></i>
            Download
        `);
        $("#download-url").attr('disabled', false);
        $("#download-url").val('');
        downloadBtn.attr('disabled', false);
    })
})
