SELECT
    a.id,
    a.campaign_id,
    b.subgroup_campaign_id,
    b.name,
    b.warna,
    c.kode_kabupaten,
    c.kode_kecamatan,
    c.kode_desa
FROM voters_campaign a
         INNER JOIN campaigns b ON a.campaign_id=b.id
         INNER JOIN voters c ON a.voters_id=c.id


ALTER TABLE `voters_campaign`
    CHANGE `campaign_id` `campaign_id` int(11) NULL AFTER `id`,
    ADD `partai_id` int(11) NULL AFTER `campaign_id`;
