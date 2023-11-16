import React from 'react';
import ReactDOM from 'react-dom';
import KakeiboTable from './KakeiboTable'; // 作成したReactコンポーネントのインポート


// ページ内でデータを渡してReactコンポーネントをレンダリング
ReactDOM.render(
    <KakeiboTable posts={posts}  category_totals={category_totals} />,
    document.getElementById('category-totals-container') // コンポーネントを表示するDOM要素
);

