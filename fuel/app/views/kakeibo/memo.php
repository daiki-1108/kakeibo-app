メモ

<table class="top_detail">
        <tr>
          <th class="category">カテゴリ</th>
          <th class="total">合計額</th>
        </tr> 
            <?php $pre_id = 0 ?>
            <?php foreach ($posts as $post): ?>
              <?php if($post->category_id != $pre_id): ?>
                  <tr> 
                    <td><a href="/kb/kakeibo/detail/<?php echo $post->category_id; ?>"><?php echo $post->category_name->name; ?></a></td>
                      <?php for($i = 0; $i < $Max_kinds; $i++): ?>
                        <?php if($post->category_id == $i): ?>
                          <td><?php  echo $category_totals[$i]; ?>円</td>
                        <?php endif; ?>
                       <?php endfor; ?>
                  </tr>
                <?php $pre_id = $post->category_id ?> 
              <?php endif; ?>
            <?php endforeach; ?>
        </table>


        {Object.keys(categoryTotals).map(categoryId=> (    //mapメソッドでループ
          <tr key={categoryId}>
            <td><a href={`/kb/kakeibo/detail/${categoryId}`}>{category_name[categoryId]}</a></td>
            <td>{categoryTotals[categoryId].total}円</td>
          </tr>
        ))}