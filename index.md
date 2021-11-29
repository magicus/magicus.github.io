## [magicus](/about)

<table style="border: 0px">
  {% for post in site.posts %}
    <tr>
      <td style="border: 0px">{{ post.date | date_to_string }}</td><td style="border: 0px"><a href="{{ post.url }}">{{ post.title }}</a></td>
<td> {{ post.excerpt }} </td>
    </tr>
  {% endfor %}
</table>
