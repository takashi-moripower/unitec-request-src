<tr>
	<th class="check text-center"><i class="fa fa-square-o fa-fw fa-2x"</th>
	<td><?= $id ?><?= $this->Form->hidden("parts.{$i}.id", ['value' => $id]) ?></td>
	<td><?= $name ?><?= $this->Form->hidden("parts.{$i}.name", ['value' => $name]) ?></td>
	<td class="text-right"><?= $cost ?><?= $this->Form->hidden("parts.{$i}.cost", ['value' => $cost]) ?></td>
	<td><?= $this->Form->select("parts.{$i}.count", range(0, 99), ['class' => 'count']) ?></td>
	<td><?= $note ?><?= $this->Form->hidden("parts.{$i}.note", ['value' => $note]) ?></td>
</tr>

