/* Select Topics and Post by a User */
SELECT 
forum_topics.TopicSubject,
forum_post.*,
Users.Id,
Users.Username
FROM forum_topics INNER JOIN forum_post ON forum_topics.Id=forum_post.Topicid
LEFT JOIN Users ON forum_post.Postedby=Users.Id WHERE forum_post.Topicid = 1; 
 
/* Selects Forum Board View*/
SELECT 
            count(forum_topics.Id) as Topic_Id,
            forum_topics.Catid as Topic_CatId,
            sum(forum_topics.Views) as Views,
            count(forum_replies.TopicId) as Topic_Replies,
            Users.Id as UserId,
            Users.Username as PostedBy
            FROM forum_topics INNER JOIN forum_category ON forum_category.Id=forum_topics.Catid
            LEFT JOIN forum_replies ON forum_topics.Id=forum_replies.Topicid
            LEFT JOIN Users ON forum_topics.Topicby=Users.Id WHERE forum_category.Id =1;


SELECT 
            forum_topics.Catid as Topic_Category,
            forum_topics.Views,
            forum_replies.TopicId as Topic_Replies,
            Users.Id as UserId,
            Users.Username as PostedBy
            FROM forum_topics INNER JOIN forum_category ON forum_category.Id=forum_topics.Catid
            LEFT JOIN forum_replies ON forum_topics.Id=forum_replies.Topicid
            LEFT JOIN Users ON forum_topics.Topicby=Users.Id 
            WHERE forum_topics.Catid = forum_category.Id