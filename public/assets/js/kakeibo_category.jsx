import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

const KakeiboTable = () => {
    const [categoryTotals, setCategoryTotals] = useState([]);
    const getCategoryTotals = () => {
        fetch('http://localhost:8080/kb/api/kakeibo/get_category_totals.json', {
            method: 'GET',
            headers: {
                "Content-Type": "application/json"
            },
        })
        .then(response => response.json())
        .then(data => {
            setCategoryTotals(data.category_totals); // データの構造に基づいて修正
        });
    }
    useEffect(() => {
        getCategoryTotals();
    }, []);
    useEffect(() => {
        console.log(categoryTotals);
    }, [categoryTotals]);


    const [showModal, setShowModal] = useState(false); // (変数,更新するための関数) = usestate(初期値)
    const [date, setDate] = useState('');
    const [amount, setAmount] = useState('');
    const [category, setCategory] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState([]);
    const [memo, setMemo] = useState('');

    const handleSubmit = (event) => {
        event.preventDefault();
        // ここでフォームデータを処理
        // 登録後の処理をここに記述
        fetch('http://localhost:8080/kb/api/kakeibo/insert_record_data.json', { //コントローラー側に送信
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({  // 送信するデータ。JSON形式に変換して指定
                date: date,
                amount: amount,
                selectedCategory: selectedCategory,
                memo: memo,
                fuel_csrf_token: current_token,
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            setShowModal(false); //モーダル非表示
        })
        
    };

    const getCategory = () => {
        fetch('http://localhost:8080/kb/api/kakeibo/get_category_names.json', { //コントローラーからデータを取得
            method: 'GET',
            headers: {
                "Content-Type": "application/json"
            },
        })
        .then(response => response.json())
        .then(data => {
            setCategory(data.category_names); // データの構造に基づいて修正
            console.log(categoryTotals);
        });
    }
    useEffect(() => { //初回レンダリング（ページ初ロード時）
        getCategory();
    }, []);
    useEffect(() => {
        console.log(category);
    }, [category]);

    return (
        <>
            <button onClick={() => setShowModal(true)}>新規登録</button>

            {showModal ? (
                <div className="modalBackground">
                    <div className="modalContainer">
                        <button className="closeButton" onClick={() => setShowModal(false)}>閉じる</button>
                        <form className="modalForm" onSubmit={handleSubmit}>
                            <h2>新規登録</h2>
                            <input
                                type="date"
                                placeholder="日付"
                                value={date}
                                onChange={(e) => setDate(e.target.value)}
                            />
                            <input
                                type="text"
                                placeholder="金額"
                                value={amount}
                                onChange={(e) => setAmount(e.target.value)}
                            />
                            <select
                                name="category"
                                required
                                value={selectedCategory}
                                onChange={(e) => setSelectedCategory(e.target.value)}
                            >
                             <option value="0">選択してください</option>
                            {category.map((option, index) => (
                                <option key={index} value={option.category_id}>
                                    {option.category_name}
                                </option>
                            ))}
                            </select>
                            <textarea
                                value={memo}
                                onChange={(e) => setMemo(e.target.value)}
                            >
                            </textarea>
                            <button type="submit">登録</button>
                        </form>
                    </div>
                </div>
            ) : null}


            <table className="top_detail">
                <thead>
                    <tr>
                        <th className="category">カテゴリ名</th>
                        <th className="total">合計額</th>
                    </tr>
                </thead>
                <tbody>
                    {categoryTotals.map((item, index) => (
                        <tr key={index}>
                            <td><a href={`/kb/kakeibo/detail/${item.category_id}`}>{item.category_name}</a></td>
                            <td>{item.total}円</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </>
    );
}
export default KakeiboTable;
ReactDOM.render(
    <KakeiboTable />,
    document.getElementById('category-totals-container')
);








