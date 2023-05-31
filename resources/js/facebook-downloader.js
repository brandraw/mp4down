

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


    $.post("/facebook/download", {
        '_token': `${$('meta[name="csrf_token"]').attr('content')}`,
        'url': url
    }).done(res => {
        res = JSON.parse(res);
        var data = `
        <div class="downloader-results-wrapper shadow">
            <h3 class="">${res.title}</h3>
            <div class="row">
                <div class="col-md-6 mb-2"><img src="${res.thumb}" width="100%"
                        class="img-thumbnail" alt=""></div>
                <div class="col-md-6">
                    <div class="text-truncate" data-toggle="tooltip" title="${res.description}"><strong>Description:
                        </strong>${res.description}</div>
                    <div class=''><h5>Downloads:</h5>`;

        data += res.links.map((v, k) => {
            return `<a href="${v.value}&dl=1" download="${res.title}.mp4" class="btn-success m-1 btn btn-large">${v.title}</a>`
        }).join('');
        data += `
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
