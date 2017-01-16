CREATE VIEW `wallets_view` AS
  SELECT
    `cw`.`id`                                                          AS `id`,
    `cw`.`client_account_id`                                           AS `client_account_id`,
    `cw`.`wallet_balance`                                              AS `wallet_balance`,
    `cw`.`status`                                                      AS `status`,
    `cw`.`created_at`                                                  AS `created_at`,
    `cw`.`updated_at`                                                  AS `updated_at`,
    concat(`m`.`surname`, ' ', `m`.`firstname`, ' ', `m`.`middlename`) AS `rider`,
    if((`cw`.`status` = 1), 'Active', 'Inactive')                      AS `wallet_status`,
    ca.bike_id,
    ca.masterfile_id
  FROM ((`ride`.`client_wallets` `cw` LEFT JOIN `ride`.`client_accounts` `ca`
      ON ((`cw`.`client_account_id` = `ca`.`id`))) LEFT JOIN `ride`.`masterfiles` `m`
      ON ((`ca`.`masterfile_id` = `m`.`id`)))