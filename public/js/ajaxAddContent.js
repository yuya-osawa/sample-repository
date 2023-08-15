// resources/js/infinite-scroll.js
$(document).ready(function () {
    //let count = 0; // コンテンツの取得件数を初期化

    $(window).on('scroll', function () {
        var document_h = $(document).height();
        var window_h = $(window).height() + $(window).scrollTop();
        var scroll_pos = (document_h - window_h) / document_h;

        if (scroll_pos <= 0.95) { // 画面最下部にスクロールされたら取得
            ajaxAddContent();
        }
    });
});
var count = 1;
function ajaxAddContent() {
    //追加コンテンツ
    var addContent = "";
    // コンテンツ件数           
    count++;
    $.ajax({
        type: "get",
        dataType: "json",
        url: '/ajax/' + count,
        data: { _token: "{{ csrf_token() }}", count: count }, // CSRF トークンを含めて送信

    }).done(function (data) {
        $.each(data, function (key, val) {
            if (val.del_flg != 1) {
                //console.log(val.title);
                //addContent += "<div>" + val.content + "</div>"; 書き方のイメージ
                addContent += `<table class="p-5 mb-5" style="margin: 10px; background-color: #ffffff;">
            <tr>

                <th scope='col' class="pr-3">
                   
                    <a href="{{ route('Post.show',${val.id}) }}">
                    ${val.title} 
                    </a>
                    ${val.date} 
                </th>
            </tr>

            <tr>
                <th scope='col' class="pl-3 pb-3">
                    画像の投稿はありません
                </th>
            </tr>
        </table>`;
            }
        });

        $("#append").append(addContent);
        count += data.length;
        $("#count").val(count);

    }).fail(function (e) {
        console.log('データを読み込めません');
        console.log(e);
    });

}