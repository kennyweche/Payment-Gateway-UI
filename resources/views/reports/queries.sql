
/*=================================================*/
/*All transactions from source clientID to destinationclientID*/
/*=================================================*/
select source,
(select clientName from clients c inner join client_channels_reference ccr on c.clientID=ccr.destinationClientID where ccr.code = destination)destination, 
amount from transactions t 
inner join request_logs r on t.requestlogID = r.requestlogID 
inner join client_channels_reference ccr on ccr.channel_ref_id = t.channel_ref_id 
where ccr.clientID=9 and ccr.destinationClientID=2 
order by 1 desc limit 10;

/*=================================================*/
/*From source clientID to any clientID*/
/*=================================================*/

select source,
count(t.transactionID), 
SUM(amount) as total, (select clientName from clients c 
inner join client_channels_reference ccr on c.clientID=ccr.destinationClientID 
where ccr.code = destination)destination from transactions t 
inner join request_logs r on t.requestlogID = r.requestlogID 
inner join client_channels_reference ccr on ccr.channel_ref_id = t.channel_ref_id 
where ccr.clientID=9 
GROUP BY r.source, r.destination

/*=================================================*/
/*From source clientID to any clientID where between dates*/
/*=================================================*/

select source,
count(t.transactionID), 
SUM(amount) as total, (select clientName from clients c 
inner join client_channels_reference ccr on c.clientID=ccr.destinationClientID 
where ccr.code = destination)destination from transactions t 
inner join request_logs r on t.requestlogID = r.requestlogID 
inner join client_channels_reference ccr on ccr.channel_ref_id = t.channel_ref_id 
where ccr.clientID=9 
where t.date_created between '2016-06-06' AND '2017-06-06'
GROUP BY r.source, r.destination

/*=================================================*/
/*From source clientID to any clientID Groupt By Month
/*=================================================*/

select source, 
count(t.transactionID), 
SUM(amount) as total, 
(select clientName from clients c 
inner join client_channels_reference ccr on c.clientID=ccr.destinationClientID 
where ccr.code = destination)destination, MONTH(t.date_created) AS month from transactions t 
inner join request_logs r on t.requestlogID = r.requestlogID 
inner join client_channels_reference ccr on ccr.channel_ref_id = t.channel_ref_id 
where ccr.clientID=9 GROUP BY r.source, r.destination, month

/*=================================================*/
/*From source clientID to desctination clientID
/*=================================================*/
select source, 
(select clientName from clients c 
inner join client_channels_reference ccr on c.clientID=ccr.destinationClientID 
where ccr.code = destination)destination, 
UM(amount), COUNT(t.transactionID) from transactions t 
inner join request_logs r on t.requestlogID = r.requestlogID 
inner join client_channels_reference ccr on ccr.channel_ref_id = t.channel_ref_id 
where ccr.clientID=9 and ccr.destinationClientID=2 
GROUP BY r.source, r.destination