function KakeiboViewModel() {
    var self = this;

    self.date = ko.observable('');
    self.amount = ko.observable('');
    self.category_id = ko.observable('');

    self.saveForm = function () {
        var formData = {
            date: self.date(),
            amount: self.amount(),
            category_id: self.category_id()
        };
    
        $.ajax({
            type: 'POST',
            url: '/kb/kakeibo/createForm', // サーバーのエンドポイント
            data: formData,
            success: function(response) {
                // サーバーからの成功応答を処理
                console.log('保存が成功しました。', response);
                // 成功時のリダイレクトなどの処理を行う
            },
            error: function(error) {
                // エラー処理
                console.error('保存中にエラーが発生しました。', error);
            }
        });
    };
}
// ViewModel をバインド
var viewModel = new KakeiboViewModel();
ko.applyBindings(viewModel);






